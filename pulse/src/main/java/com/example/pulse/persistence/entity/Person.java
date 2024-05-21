package com.example.pulse.persistence.entity;

import java.util.Set;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.OneToMany;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import com.example.pulse.persistence.entity.History;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class Person {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer personID;

    private String name;
    private Integer age;
    private String email;
    
    @ManyToOne
    @JoinColumn(name = "appID")
    private WebApplication webApplication;

    @OneToMany(mappedBy = "person")
    private Set<PulseData> pulseData;

    @OneToMany(mappedBy = "person")
    private Set<History> history;
}

