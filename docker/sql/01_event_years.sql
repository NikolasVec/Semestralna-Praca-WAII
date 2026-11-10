CREATE TABLE IF NOT EXISTS event_years (
            id INT PRIMARY KEY,
            year SMALLINT NOT NULL UNIQUE,
            pocet_ucastnikov INT NOT NULL DEFAULT 0
);

INSERT INTO event_years (id, year)
VALUES
    (2025, 2025),
    (2026, 2026),
    (2027, 2027);