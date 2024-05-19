package com.example.pulse.persistence.entity;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class PulseDetectorDevice {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer deviceID;

    private String deviceModel;
    private String manufacturer;
    private String serialNumber;

    // Getters and setters
}
