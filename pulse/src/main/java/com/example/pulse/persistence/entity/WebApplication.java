package com.example.pulse.persistence.entity;

import java.util.Set;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class WebApplication {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer appID;

    private String appName;
    private String version;

    @OneToMany(mappedBy = "webApplication")
    private Set<Person> persons;
}

