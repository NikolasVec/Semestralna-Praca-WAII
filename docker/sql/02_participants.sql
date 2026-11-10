
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    birth_date DATE NOT NULL,
    event_year_id INT NOT NULL,
    time TIME NULL,

    CONSTRAINT fk_participants_event_year
    FOREIGN KEY (event_year_id)
    REFERENCES event_years(id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );

-- Pridanie účastníka
CREATE TRIGGER participants_after_insert
    AFTER INSERT ON participants
    FOR EACH ROW
    UPDATE event_years
    SET pocet_ucastnikov = pocet_ucastnikov + 1
    WHERE id = NEW.event_year_id;

-- Vymazanie účastníka
CREATE TRIGGER participants_after_delete
    AFTER DELETE ON participants
    FOR EACH ROW
    UPDATE event_years
    SET pocet_ucastnikov = pocet_ucastnikov - 1
    WHERE id = OLD.event_year_id;

-- Presunutie účastníka do iného ročníka
CREATE TRIGGER participants_after_update
    AFTER UPDATE ON participants
    FOR EACH ROW
    UPDATE event_years AS e
    SET pocet_ucastnikov = (
        SELECT COUNT(*)
        FROM participants AS p
        WHERE p.event_year_id = e.id
    )
    WHERE e.id IN (OLD.event_year_id, NEW.event_year_id);

INSERT INTO participants
(first_name, last_name, email, birth_date, event_year_id, time)
VALUES
-- Rocnik 2025
('Jan', 'Novak', 'jan.novak@example.com', '1999-03-15', 2025, '00:42:15'),
('Peter', 'Kovac', 'peter.kovac@example.com', '2001-07-22', 2025, '00:38:40'),
('Martin', 'Polak', 'martin.polak@example.com', '1998-11-05', 2025, '00:51:12'),
('Eva', 'Kralova', 'eva.kralova@example.com', '2002-06-18', 2025, '00:46:30'),
('Lucia', 'Biela', 'lucia.biela@example.com', '2000-09-10', 2025, '00:55:05'),

-- Rocnik 2026
('Tomas', 'Horvath', 'tomas.horvath@example.com', '1997-02-25', 2026, '00:36:18'),
('Marek', 'Svec', 'marek.svec@example.com', '2003-12-01', 2026, '00:44:52'),
('Zuzana', 'Mala', 'zuzana.mala@example.com', '2001-04-14', 2026, '00:49:35'),
('Andrea', 'Hudakova', 'andrea.hudakova@example.com', '1999-08-30', 2026, '00:41:09'),
('Michal', 'Fedor', 'michal.fedor@example.com', '2002-10-07', 2026, '00:53:21'),

-- Rocnik 2027
('Samuel', 'Urban', 'samuel.urban@example.com', '2000-01-12', 2027, NULL),
('Daniel', 'Balaz', 'daniel.balaz@example.com', '1998-05-19', 2027, NULL),
('Katarina', 'Vargova', 'katarina.vargova@example.com', '2003-03-08', 2027, NULL),
('Filip', 'Mikula', 'filip.mikula@example.com', '2001-09-27', 2027, NULL),
('Nikola', 'Benova', 'nikola.benova@example.com', '2002-12-16', 2027, NULL);

