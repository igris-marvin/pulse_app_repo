package com.swp.k.persistence.entity;
import java.util.List;

import org.hibernate.annotations.DynamicInsert;
import org.hibernate.annotations.DynamicUpdate;

import jakarta.persistence.CascadeType;
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
public class PulseDetectorDevice {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer device_id;

    @OneToMany(cascade = CascadeType.ALL, fetch = FetchType.LAZY)
    @JoinColumn(name = "device_id")
    private List<PulseData> pulse_data;

    @OneToOne(mappedBy = "pulseDetectorDevice")
    private EmotionRegulatorApp emotionRegulatorApp;

    public PulseDetectorDevice(List<PulseData> pulse_data, EmotionRegulatorApp emotionRegulatorApp) {
        this.pulse_data = pulse_data;
        this.emotionRegulatorApp = emotionRegulatorApp;
    }
}
