
CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    birth_date DATE NOT NULL,
    event_year_id INT NOT NULL,
    time TIME NULL,

    FOREIGN KEY (event_year_id)
    REFERENCES event_years(id)
    ON DELETE RESTRICT
    );
