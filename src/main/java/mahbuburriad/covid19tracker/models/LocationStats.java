package mahbuburriad.covid19tracker.models;

public class LocationStats {
    //for confirmed stats
    private String state;
    private String country;
    private String lat;
    private String lon;
    private int latestTotalCases;
    private int diffFromPrevDay;

    //for recovered stats
    private int latestRecoveredCases;
    private int diffFromPrevRecovered;

    //for death stats
    private int lastestDeathCases;
    private int diffFromPrevDeath;

    //get the value for confimed different from previous day
    public int getDiffFromPrevDay() {
        return diffFromPrevDay;
    }
    //set the value for confimed different from previous day
    public void setDiffFromPrevDay(int diffFromPrevDay) {
        this.diffFromPrevDay = diffFromPrevDay;
    }
    //get the latitude
    public String getLat() {
        return lat;
    }
    //set the latitude
    public void setLat(String lat) {
        this.lat = lat;
    }
    //get the longitude
    public String getLon() {
        return lon;
    }
    //set the longitude
    public void setLon(String lon) {
        this.lon = lon;
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
                ", lat='" + lat + '\'' +
                ", lon='" + lon + '\'' +
                ", latestTotalCases=" + latestTotalCases +
                ", diffFromPrevDay=" + diffFromPrevDay +
                ", latestRecoveredCases=" + latestRecoveredCases +
                ", diffFromPrevRecovered=" + diffFromPrevRecovered +
                ", lastestDeathCases=" + lastestDeathCases +
                ", diffFromPrevDeath=" + diffFromPrevDeath +
                '}';
    }
}
