package com.example.pulse.persistence.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.pulse.persistence.entity.PulseDetectorDevice;

@Repository
public interface PulseDetectorDeviceRepository extends JpaRepository<PulseDetectorDevice, Integer> {
    
}
