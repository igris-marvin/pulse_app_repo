package com.swp.k.persistence.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.swp.k.persistence.entity.EmotionRegulatorApp;

@Repository
public interface EmotionRegulatorAppRepository extends JpaRepository<EmotionRegulatorApp, Integer>{
    
}
