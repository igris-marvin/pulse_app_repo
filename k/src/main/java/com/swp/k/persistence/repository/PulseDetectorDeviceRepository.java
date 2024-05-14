package com.swp.k.persistence.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.swp.k.persistence.entity.PulseDetectorDevice;

@Repository
public interface PulseDetectorDeviceRepository extends JpaRepository<PulseDetectorDevice, Integer> {
    
}
