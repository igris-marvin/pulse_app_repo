package com.swp.k.persistence.entity;

import org.hibernate.annotations.DynamicInsert;
import org.hibernate.annotations.DynamicUpdate;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
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
public class EmotionRegulatorApp {
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer pulse_app_id;

    @Column(length = 25, nullable = true)
    private String mood;
    
    @OneToOne(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "pulse_device_id")
    private PulseDetectorDevice pulseDetectorDevice;

    @OneToOne(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "member_id")
    private Member member;

    public EmotionRegulatorApp(String mood, PulseDetectorDevice pulseDetectorDevice) {
        this.mood = mood;
        this.pulseDetectorDevice = pulseDetectorDevice;
    }
}
