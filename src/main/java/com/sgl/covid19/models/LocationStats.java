package com.sgl.covid19.models;

public class LocationStats {
    //for confirmed stats
    private String state;
    private String country;
    private Double latitude;
    private Double longitude;
    private int latestTotalCases;
    private int diffFromPrevDay;

    //for recovered stats
    private String recover_State;
    private String recover_Country;
    private int latestRecoveredCases;
    private int diffFromPrevRecovered;

    //for death stats
    private String death_State;
    private String death_Country;
    private int lastestDeathCases;
    private int diffFromPrevDeath;


    //get Recover state data
    public String getRecover_State() {
        return recover_State;
    }
    //set Recover state Data
    public void setRecover_State(String recover_State) {
        this.recover_State = recover_State;
    }

    //get Recover country data
    public String getRecover_Country() {
        return recover_Country;
    }
    //set Recover country data
    public void setRecover_Country(String recover_Country) {
        this.recover_Country = recover_Country;
    }

    //get death state data
    public String getDeath_State() {
        return death_State;
    }
    //set death state data
    public void setDeath_State(String death_State) {
        this.death_State = death_State;
    }
    //get death country data
    public String getDeath_Country() {
        return death_Country;
    }
    //set death country data
    public void setDeath_Country(String death_Country) {
        this.death_Country = death_Country;
    }

    //get the value for confimed different from previous day
    public int getDiffFromPrevDay() {
        return diffFromPrevDay;
    }
    //set the value for confimed different from previous day
    public void setDiffFromPrevDay(int diffFromPrevDay) {
        this.diffFromPrevDay = diffFromPrevDay;
    }
    //get the latitude
    public Double getLat() {
        return latitude;
    }
    //set the latitude
    public void setLat(Double lat) {
        this.latitude = lat;
    }
    //get the longitude
    public Double getLon() {
        return longitude;
    }
    //set the longitude
    public void setLon(Double lon) {
        this.longitude = lon;
    }
    //get the states
    public String getState() {
        return state;
    }
    //set states
    public void setState(String state) {
        this.state = state;
    }
    //get country
    public String getCountry() {
        return country;
    }
    //set country
    public void setCountry(String country) {
        this.country = country;
    }
    //get latest total cases (confirmed)
    public int getLatestTotalCases() {
        return latestTotalCases;
    }
    //set latest total cases (confirmed)
    public void setLatestTotalCases(int latestTotalCases) {
        this.latestTotalCases = latestTotalCases;
    }
    //get latest recovered cases
    public int getLatestRecoveredCases() {
        return latestRecoveredCases;
    }
    //set latest recovered cases
    public void setLatestRecoveredCases(int latestRecoveredCases) {
        this.latestRecoveredCases = latestRecoveredCases;
    }
    //get difference from previous recovered data
    public int getDiffFromPrevRecovered() {
        return diffFromPrevRecovered;
    }
    //set difference from previous recovered data
    public void setDiffFromPrevRecovered(int diffFromPrevRecovered) {
        this.diffFromPrevRecovered = diffFromPrevRecovered;
    }
    //get latest Death cases
    public int getLastestDeathCases() {
        return lastestDeathCases;
    }
    //set latest death cases
    public void setLastestDeathCases(int lastestDeathCases) {
        this.lastestDeathCases = lastestDeathCases;
    }
    //get difference from previous death
    public int getDiffFromPrevDeath() {
        return diffFromPrevDeath;
    }
    //get difference from previous date
    public void setDiffFromPrevDeath(int diffFromPrevDeath) {
        this.diffFromPrevDeath = diffFromPrevDeath;
    }

    //all data to string format from raw data


    @Override
    public String toString() {
        return "LocationStats{" +
                "state='" + state + '\'' +
                ", country='" + country + '\'' +
                ", latitude=" + latitude +
                ", longitude=" + longitude +
                ", latestTotalCases=" + latestTotalCases +
                ", diffFromPrevDay=" + diffFromPrevDay +
                ", recover_State='" + recover_State + '\'' +
                ", recover_Country='" + recover_Country + '\'' +
                ", latestRecoveredCases=" + latestRecoveredCases +
                ", diffFromPrevRecovered=" + diffFromPrevRecovered +
                ", death_State='" + death_State + '\'' +
                ", death_Country='" + death_Country + '\'' +
                ", lastestDeathCases=" + lastestDeathCases +
                ", diffFromPrevDeath=" + diffFromPrevDeath +
                '}';
    }
}
