Our team is developing a Web App called 'Pulse App'

More of an emotional regulator app, this web app is able to read a user's pulse rate and determine their emotion/mood then display to the user that information

An external device(Pulse detector Device) programmed using Arduino is used to  

clients are able to create and manage their own account on the 'Pulse App' 

It also includes a music player with limited songs(soon to be updated) where the user can play their choice of music

Software Program
  > xampp

Integrated Development Environment:
  > Virtual Studio Code

Programming Languages:
  > php
  > HTML
  > CSS
  > Bootstrap CSS
  > javascript
  > Node js

Web server
  > Apache HTTP Server

Database Management System:
  > MySQL / MariaDB

Source Code Management:
  > GitHub

The pulse detector device was programmed using the following tools

Integrated Development Environment (IDE)
  > Arduino
  > Cool Term

TOOLS
  > I2C 1602 LCD display
  > Jumper wires
  > Arduino board 
  > USB cable type B
  > Pulse sensor 

Programming Languages 
  > C/C++


# PLANNING AND DESIGN

## STRUCTURE 

client site
- log in and sign up
- record pulse rate and get results
- play music of your choice
- upload and save local music you wanna play
- view user page
  > update details
  > delete account
  > upload image
- page more details about active pulse rate report
- page for explaining how pulse rates work and possible mediation that can help
- see graphs for pulse rates measured

admin site
- log in
- view summary of data
  > users
  > most played songs
  > recently recorded pulse rates
  > 
- view user info
- export user reports
- suspend/delete user accounts
- upload music -> DMCA free music
- see user uploaded music

system
- record user pulse rates
- save user login info
- generate reports

## PAGES

WELCOME_PAGE

CLIENT_SIGN_UP_PAGE
CLIENT_LOGIN_PAGE
CLIENT_HOME_PAGE
CLIENT_USER_PAGE
CLIENT_FEED_PAGE
CLIENT_HELP_PAGE
CLIENT_MUSIC_PAGE > show dev uploaded music and user uploaded music, categorized into 3 moods
CLIENT_TRENDS_PAGE > graphs, list of pulse rate records, list of averages, with timestamps

ADMIN_LOGIN_PAGE
ADMIN_DASHBOARD_PAGE
ADMIN_USER_PAGE
ADMIN_RECORDS_PAGE

TERMS_AND_CONDITIONS_PAGE

## DATABASE

user
- id
- name
- surname
- email
- password - encrypted
- phone
- role ["CLIENT", "ADMINISTRATOR"]
- share_information
- username

pulse rate
- id
- bpm
- timestamp
- user -> many to one

average pulse rate
- id
- mood ["HYPER", "NORMAL", "SAD"]
- timestamp
- pulse_rate -> one to many
- user -> many to one

pulse_detector_source
- id
- name
- path
- user -> one to one