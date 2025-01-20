-- Update existing memberships with fees
UPDATE memberships SET
    biaya_bulanan = 0,
    biaya_upgrade = 0,
    biaya_downgrade = 0
WHERE membership_id > 0;

-- Set specific fees for each membership level
UPDATE memberships SET
    biaya_bulanan = 50000,     -- Rp 50.000
    biaya_upgrade = 100000,    -- Rp 100.000
    biaya_downgrade = 25000    -- Rp 25.000
WHERE rank = 1;                -- Basic membership

UPDATE memberships SET
    biaya_bulanan = 100000,    -- Rp 100.000
    biaya_upgrade = 200000,    -- Rp 200.000
    biaya_downgrade = 50000    -- Rp 50.000
WHERE rank = 2;                -- Standard membership

UPDATE memberships SET
    biaya_bulanan = 200000,    -- Rp 200.000
    biaya_upgrade = 400000,    -- Rp 400.000
    biaya_downgrade = 100000   -- Rp 100.000
WHERE rank = 3;                -- Premium membership

UPDATE memberships SET
    biaya_bulanan = 500000,    -- Rp 500.000
    biaya_upgrade = 0,         -- No upgrade available for highest tier
    biaya_downgrade = 250000   -- Rp 250.000
WHERE rank = 4;                -- Enterprise membership

-- Add fees for rank 5 (VIP/Ultimate membership)
UPDATE memberships SET
    biaya_bulanan = 1000000,   -- Rp 1.000.000
    biaya_upgrade = 0,         -- No upgrade available (highest tier)
    biaya_downgrade = 500000   -- Rp 500.000
WHERE rank = 5;                -- VIP/Ultimate membership
