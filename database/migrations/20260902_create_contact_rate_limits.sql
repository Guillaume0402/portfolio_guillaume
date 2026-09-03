CREATE TABLE IF NOT EXISTS contact_rate_limits (
    route VARCHAR(100)
        CHARACTER SET ascii
        COLLATE ascii_bin
        NOT NULL,

    key_hash CHAR(64)
        CHARACTER SET ascii
        COLLATE ascii_bin
        NOT NULL,

    window_started_at DATETIME(6) NOT NULL,

    attempt_count SMALLINT UNSIGNED
        NOT NULL
        DEFAULT 0,

    blocked_until DATETIME(6) DEFAULT NULL,

    updated_at DATETIME(6) NOT NULL,

    PRIMARY KEY (route, key_hash),

    INDEX idx_contact_rate_limits_updated_at (updated_at),

    INDEX idx_contact_rate_limits_blocked_until (blocked_until)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
