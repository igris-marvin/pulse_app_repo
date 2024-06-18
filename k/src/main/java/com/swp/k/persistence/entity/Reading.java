package com.swp.k.persistence.entity;

import java.util.Date;

import org.hibernate.annotations.DynamicInsert;
import org.hibernate.annotations.DynamicUpdate;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@DynamicInsert
@DynamicUpdate
@NoArgsConstructor
@AllArgsConstructor
public class Reading {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer reading_id;

    @Column(nullable = false)
    private String mood;

    @Column(nullable = false)
    private Integer average;

    @Temporal(value = TemporalType.TIMESTAMP)
    private Date timestamp;

    public Reading(String mood, Integer average, Date timestamp) {
        this.mood = mood;
        this.average = average;
        this.timestamp = timestamp;
    }
}
