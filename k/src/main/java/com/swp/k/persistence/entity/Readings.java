package com.swp.k.persistence.entity;

import java.util.Date;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class Readings {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer reading_id;
    private Integer pulse_rate;

    @Temporal(value = TemporalType.TIMESTAMP)
    private Date timestamp;

    public Readings(Integer pulse_rate, Date timestamp) {
        this.pulse_rate = pulse_rate;
        this.timestamp = timestamp;
    }
}
