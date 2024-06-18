package com.swp.k.persistence.entity;

import java.util.List;

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
import jakarta.persistence.OneToMany;
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

    @OneToMany(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "pulse_app_id")
    private List<Reading> readings;
    
    @OneToOne(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "pulse_device_id")
    private PulseDetectorDevice pulseDetectorDevice;

    @OneToOne(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "member_id")
    private Member member;

    public EmotionRegulatorApp(List<Reading> readings, PulseDetectorDevice pulseDetectorDevice, Member member) {
        this.readings = readings;
        this.pulseDetectorDevice = pulseDetectorDevice;
        this.member = member;
    }
}
