package com.example.pulse.persistence.entity;

import java.util.Date;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class History {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer historyID;

    @ManyToOne
    @JoinColumn(name = "pulseDataID")
    private PulseData pulseData;

    @ManyToOne
    @JoinColumn(name = "deviceID")
    private PulseDetectorDevice device;

    @ManyToOne
    @JoinColumn(name = "personID")
    private Person person;

    private Date timestamp;
    private Integer bpm;

    // Getters and setters
}