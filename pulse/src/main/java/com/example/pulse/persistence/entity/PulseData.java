package com.example.pulse.persistence.entity;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.Date;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class PulseData {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer dataID;

    @ManyToOne
    @JoinColumn(name = "deviceID")
    private PulseDetectorDevice device;

    @ManyToOne
    @JoinColumn(name = "personID")
    private Person person;

    @Temporal(value = TemporalType.TIMESTAMP)
    private Date timestamp;
    private Integer bpm;
}

