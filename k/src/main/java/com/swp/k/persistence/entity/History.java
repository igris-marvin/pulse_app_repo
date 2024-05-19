package com.swp.k.persistence.entity;

import java.util.Date;
import java.util.List;

import jakarta.persistence.CollectionTable;
import jakarta.persistence.ElementCollection;
import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Entity
@NoArgsConstructor
@AllArgsConstructor
public class History {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer history_id;

    @CollectionTable(name = "pulse_rate_history", joinColumns = { @JoinColumn(name = "history_id")} )
    @ElementCollection(fetch = FetchType.LAZY)
    private List<Integer> pulse_rate;

    private String mood;

    @Temporal(value = TemporalType.DATE)
    private Date date_added;
}
