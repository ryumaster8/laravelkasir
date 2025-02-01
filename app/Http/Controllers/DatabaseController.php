<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DatabaseController extends Controller
{
    public function showCreateTable()
    {
        return view('database.show-create-table');
    }

    public function showTables(Request $request)
    {
        try {
            // Get all tables from the database
            $tables = DB::select('SHOW TABLES');
            $tableStructures = [];
            
            // Get the create statement for each table
            foreach ($tables as $table) {
                $tableName = current((array)$table);
                $createStatement = DB::select("SHOW CREATE TABLE $tableName");
                $tableStructures[$tableName] = $createStatement[0]->{'Create Table'};
            }

            return view('database.show-create-table', [
                'tables' => $tableStructures,
                'showResults' => true
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error connecting to database: ' . $e->getMessage());
        }
    }

    public function backupView()
    {
        $tables = DB::select('SHOW TABLES');
        $tableNames = array_map(function($table) {
            return current((array)$table);
        }, $tables);
        
        return view('owner.database.export', ['tables' => $tableNames]); // Changed from backup to export
    }

    public function generateBackup(Request $request)
    {
        try {
            $format = $request->input('format', 'sql');
            $tables = $request->input('tables', []);
            $options = [
                'add_drop_table' => $request->has('add_drop_table'),
                'add_create_table' => $request->has('add_create_table'),
                'add_data' => $request->has('add_data'),
            ];
            
            $filename = 'backup_' . Carbon::now()->format('Y-m-d_H-i-s') . '.' . $format;
            $backupPath = storage_path('app/backups/' . $filename);
            
            if (!file_exists(storage_path('app/backups'))) {
                mkdir(storage_path('app/backups'), 0755, true);
            }

            switch($format) {
                case 'sql':
                    return $this->generateSqlBackup($tables, $options, $backupPath);
                case 'csv':
                    return $this->generateCsvBackup($tables, $backupPath);
                case 'json':
                    return $this->generateJsonBackup($tables, $backupPath);
                default:
                    throw new \Exception('Unsupported format');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating backup: ' . $e->getMessage());
        }
    }

    private function generateSqlBackup($tables, $options, $backupPath)
    {
        // Header exactly matching phpMyAdmin
        $output = "-- phpMyAdmin SQL Dump\n";
        $output .= "-- version 5.2.1\n";
        $output .= "-- https://www.phpmyadmin.net/\n";
        $output .= "--\n";
        $output .= "-- Host: " . config('database.connections.mysql.host') . "\n";
        $output .= "-- Waktu pembuatan: " . Carbon::now()->format('d M Y') . " pada " . Carbon::now()->format('H.i') . "\n";
        $output .= "-- Versi server: " . DB::select('SELECT VERSION() as version')[0]->version . "\n";
        $output .= "-- Versi PHP: " . phpversion() . "\n\n";

        $output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
        $output .= "START TRANSACTION;\n";
        $output .= "SET time_zone = \"+00:00\";\n\n\n";

        $output .= "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n";
        $output .= "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n";
        $output .= "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n";
        $output .= "/*!40101 SET NAMES utf8mb4 */;\n\n";

        $output .= "--\n";
        $output .= "-- Database: `" . config('database.connections.mysql.database') . "`\n";
        $output .= "--\n\n";

        // Get and sort all tables if none specified
        if (empty($tables)) {
            $tables = DB::select('SHOW TABLES');
            $tables = array_map(function($table) {
                return current((array)$table);
            }, $tables);
        }

        $sortedTables = $this->sortTablesByDependency($tables);

        foreach ($sortedTables as $table) {
            // Table separator
            $output .= "-- --------------------------------------------------------\n\n";

            // Table structure header
            $output .= "--\n";
            $output .= "-- Struktur dari tabel `$table`\n";
            $output .= "--\n\n";

            // Drop and create table with exact same format
            $output .= "DROP TABLE IF EXISTS `$table`;\n";
            $createTable = DB::select("SHOW CREATE TABLE `$table`")[0];
            $createTableStmt = $createTable->{'Create Table'};
            
            // Ensure CREATE TABLE statement ends with proper formatting
            if (!str_ends_with($createTableStmt, ';')) {
                $createTableStmt .= ";";
            }
            $output .= $createTableStmt . "\n\n";

            // Data inserts
            $rows = DB::table($table)->get();
            if ($rows->count() > 0) {
                $output .= "--\n";
                $output .= "-- Dumping data untuk tabel `$table`\n";
                $output .= "--\n\n";

                $columns = array_keys((array)$rows[0]);
                $columnsList = "`" . implode("`, `", $columns) . "`";

                // Group by 100 rows per INSERT statement
                $values = [];
                foreach ($rows as $row) {
                    $rowValues = array_map(function ($value) {
                        if (is_null($value)) return "NULL";
                        if (is_numeric($value) && !is_string($value)) return $value;
                        return "'" . addslashes($value) . "'";
                    }, (array)$row);
                    $values[] = "(" . implode(", ", $rowValues) . ")";
                }

                $chunks = array_chunk($values, 100);
                foreach ($chunks as $chunk) {
                    $output .= "INSERT INTO `$table` ($columnsList) VALUES\n";
                    $output .= implode(",\n", $chunk) . ";\n\n";
                }
            }
        }

        // Footer with exact same format
        $output .= "COMMIT;\n\n";
        $output .= "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n";
        $output .= "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n";
        $output .= "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n";

        file_put_contents($backupPath, $output);

        // Return with exact same filename format: laravel_kasir (1).sql
        return response()->download($backupPath, 
            config('database.connections.mysql.database') . ' (1).sql'
        )->deleteFileAfterSend();
    }

    private function sortTablesByDependency($tables)
    {
        // Define base tables (no dependencies) first
        $baseTables = [
            'migrations',
            'sessions',
            'cache',
            'cache_locks',
            'failed_jobs',
            'job_batches',
            'roles',
            'memberships',
        ];

        // Define complete dependency map
        $dependencies = [
            'users' => ['roles'],
            'outlet_groups' => ['users'],
            'outlets' => ['users', 'memberships'],
            'activity_logs' => ['users', 'outlets'],
            'user_permissions' => ['users', 'outlets', 'roles'],
            'suppliers' => ['users', 'outlets'],
            'categories' => ['users', 'outlets'],
            'products' => ['outlets', 'categories', 'suppliers'],
            'product_images' => ['products', 'outlets', 'users'],
            'product_serials' => ['products', 'outlets', 'users'],
            'product_stock' => ['products', 'outlets'],
            'product_transits' => ['products', 'product_serials', 'outlets', 'users'],
            'product_types' => ['users', 'outlets'],
            'wholesale_customers' => ['outlets', 'users'],
            'transactions' => ['users', 'outlets', 'wholesale_customers'],
            'transaction_items' => ['transactions', 'products', 'outlets', 'users', 'product_serials'],
            'services' => ['users', 'outlets', 'teknisi'],
            'teknisi' => ['users', 'outlets'],
            'cash_registers' => ['users', 'outlets'],
            'kas_awal' => ['users', 'outlets'],
            'kas_akhir' => ['users', 'outlets'],
            'kas_adjustments' => ['users', 'outlets'],
            'penambahan_kas' => ['users', 'outlets'],
            'penarikan_kas' => ['users', 'outlets'],
            'banks' => ['outlets'],
            'discounts' => ['users', 'outlets', 'products', 'categories'],
            'warranties' => ['users', 'outlets', 'products'],
            'payment_confirmations' => ['users', 'outlets'],
            'membership_history' => ['outlets', 'memberships', 'users'],
            'membership_change_requests' => ['outlets', 'memberships', 'users'],
        ];

        $sorted = [];
        $visited = [];

        // Add base tables first
        foreach ($baseTables as $table) {
            if (in_array($table, $tables)) {
                $sorted[] = $table;
                $visited[$table] = true;
            }
        }

        // Helper function for topological sort
        $visit = function($table) use (&$visit, &$sorted, &$visited, $dependencies) {
            if (isset($visited[$table])) {
                return;
            }

            $visited[$table] = true;

            if (isset($dependencies[$table])) {
                foreach ($dependencies[$table] as $dependency) {
                    $visit($dependency);
                }
            }

            $sorted[] = $table;
        };

        // Sort remaining tables
        foreach ($tables as $table) {
            if (!isset($visited[$table])) {
                $visit($table);
            }
        }

        return array_unique($sorted);
    }

    private function generateCsvBackup($tables, $backupPath)
    {
        $zip = new \ZipArchive();
        $zipPath = $backupPath . '.zip';
        $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($tables as $table) {
            $output = fopen('php://temp', 'r+');
            
            // Add headers
            $columns = array_keys((array)DB::table($table)->first());
            fputcsv($output, $columns);
            
            // Add data
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                fputcsv($output, (array)$row);
            }
            
            rewind($output);
            $zip->addFromString($table . '.csv', stream_get_contents($output));
            fclose($output);
        }
        
        $zip->close();
        
        return response()->download($zipPath)->deleteFileAfterSend();
    }

    private function generateJsonBackup($tables, $backupPath)
    {
        $data = [];
        
        foreach ($tables as $table) {
            $data[$table] = [
                'structure' => DB::select("SHOW CREATE TABLE `$table`")[0]->{'Create Table'},
                'data' => DB::table($table)->get()
            ];
        }
        
        file_put_contents($backupPath, json_encode($data, JSON_PRETTY_PRINT));
        
        return response()->download($backupPath)->deleteFileAfterSend();
    }

    public function restoreView()
    {
        return view('owner.database.restore');
    }

    public function restore(Request $request)
    {
        try {
            // Modify validation to accept any text file as SQL
            $request->validate([
                'backup_file' => 'required|file|mimes:sql,zip,json,txt|max:10240'
            ]);

            $file = $request->file('backup_file');
            // Check actual file content instead of just extension
            $extension = strtolower($file->getClientOriginalExtension());
            $mimeType = $file->getMimeType();
            $clearTables = $request->has('clear_tables');
            $ignoreErrors = $request->has('ignore_errors');

            // Accept text files as potential SQL files
            if (($extension === 'sql' || $mimeType === 'text/plain') && $this->isSqlFile($file)) {
                $this->restoreFromSql($file, $clearTables, $ignoreErrors);
            } elseif ($extension === 'zip') {
                $this->restoreFromCsv($file, $clearTables, $ignoreErrors);
            } elseif ($extension === 'json' || $mimeType === 'application/json') {
                $this->restoreFromJson($file, $clearTables, $ignoreErrors);
            } else {
                throw new \Exception('Unsupported file format');
            }

            return redirect()->back()->with('success', 'Database restored successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error restoring database: ' . $e->getMessage());
        }
    }

    // Add new helper method to check if file content looks like SQL
    private function isSqlFile($file)
    {
        $content = file_get_contents($file->getRealPath());
        // Check if content contains common SQL keywords
        return (
            stripos($content, 'CREATE TABLE') !== false ||
            stripos($content, 'INSERT INTO') !== false ||
            stripos($content, 'DROP TABLE') !== false
        );
    }

    private function restoreFromSql($file, $clearTables, $ignoreErrors)
    {
        $sql = file_get_contents($file->getRealPath());
        $statements = array_filter(array_map('trim', explode(';', $sql)));

        DB::beginTransaction();
        try {
            if ($clearTables) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                foreach (DB::select('SHOW TABLES') as $table) {
                    $tableName = current((array)$table);
                    DB::statement("DROP TABLE IF EXISTS `$tableName`");
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }

            foreach ($statements as $statement) {
                try {
                    DB::statement($statement);
                } catch (\Exception $e) {
                    if (!$ignoreErrors) throw $e;
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function restoreFromCsv($zipFile, $clearTables, $ignoreErrors)
    {
        // Implementation for CSV restoration
        // This would involve extracting the ZIP file and processing each CSV
        throw new \Exception('CSV restore not implemented yet');
    }

    private function restoreFromJson($file, $clearTables, $ignoreErrors)
    {
        $data = json_decode(file_get_contents($file->getRealPath()), true);
        
        DB::beginTransaction();
        try {
            if ($clearTables) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                foreach (array_keys($data) as $table) {
                    DB::statement("DROP TABLE IF EXISTS `$table`");
                }
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            }

            foreach ($data as $table => $tableData) {
                // Create table
                try {
                    DB::statement($tableData['structure']);
                    
                    // Insert data
                    foreach ($tableData['data'] as $row) {
                        DB::table($table)->insert($row);
                    }
                } catch (\Exception $e) {
                    if (!$ignoreErrors) throw $e;
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function showModels()
    {
        $modelPath = app_path('Models');
        $models = collect(); // Initialize as collection
        
        if (is_dir($modelPath)) {
            $files = scandir($modelPath);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $content = file_get_contents($modelPath . '/' . $file);
                    $models->push([
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'content' => $content
                    ]);
                }
            }
        }
        
        return view('owner.database.models', compact('models'));
    }

    public function showControllers()
    {
        $controllerPath = app_path('Http/Controllers');
        $controllers = collect();
        
        if (is_dir($controllerPath)) {
            $files = scandir($controllerPath);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $content = file_get_contents($controllerPath . '/' . $file);
                    $controllers->push([
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'content' => $content
                    ]);
                }
            }
        }
        
        return view('owner.database.controllers', compact('controllers'));
    }
}
