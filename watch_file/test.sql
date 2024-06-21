INSERT INTO pulse_data (pulse_rate, device_id) 
VALUES (?, (
    SELECT e.pulse_device_id 
    FROM emotion_regulator_app e
    WHERE e.member_id = ?;
));