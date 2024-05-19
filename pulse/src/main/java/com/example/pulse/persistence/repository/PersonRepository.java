package com.example.pulse.persistence.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.pulse.persistence.entity.Person;

@Repository
public interface PersonRepository extends JpaRepository<Person, Integer> {
    
}
