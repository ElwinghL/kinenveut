CREATE VIEW v_State
AS SELECT 0 AS id, 'is_waiting' AS name
    UNION SELECT 1 AS id, 'is_online' AS name
    UNION SELECT 2 AS id, 'is_canceled' AS name
    UNION SELECT 3 AS id, 'is_aborted' AS name
    UNION SELECT 4 AS id, 'is_finished' AS name
    UNION SELECT 5 AS id, 'is_refused' AS name
    UNION SELECT 6 AS id, 'is_banned' AS name;