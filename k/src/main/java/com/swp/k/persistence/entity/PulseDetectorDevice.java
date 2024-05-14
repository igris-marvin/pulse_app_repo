package com.swp.k.persistence.entity;
import org.hibernate.annotations.DynamicInsert;
import org.hibernate.annotations.DynamicUpdate;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToOne;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@DynamicInsert
@DynamicUpdate
@NoArgsConstructor
@AllArgsConstructor
public class PulseDetectorDevice {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer device_id;
    private Integer pulse_rate;

    @OneToOne(mappedBy = "pulseDetectorDevice")
    private EmotionRegulatorApp emotionRegulatorApp;
}
