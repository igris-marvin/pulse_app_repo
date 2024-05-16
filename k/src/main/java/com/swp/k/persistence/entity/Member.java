package com.swp.k.persistence.entity;

import java.util.Date;

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
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Entity
@Data
@DynamicInsert
@DynamicUpdate
@NoArgsConstructor
@AllArgsConstructor
public class Member {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer member_id;

    @Column(length = 13, nullable = false, unique = true)
    private String id_number;

    @Column(nullable = false, columnDefinition = "LONGBLOB")
    private byte[] image;

    @Column(nullable = false, length = 25, unique = true)
    private String username;

    @Column(nullable = false, length = 25)
    private String name;

    @Column(nullable = false, length = 255)
    private String password;

    @Column(nullable = false)
    @Temporal(value = TemporalType.DATE)
    private Date dob;

    @Column(nullable = false, columnDefinition = "CHAR", length = 1)
    private char gender;

    @Column(nullable = false, length = 8)
    private String role;

    @Column(nullable = true)
    private Integer mgr;

    @Column(nullable = true)
    private Boolean tcs;

    @OneToOne(mappedBy = "member")
    private EmotionRegulatorApp emotionRegulatorApp;
}
