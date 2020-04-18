package mahbuburriad.covid19tracker.models;

public class LocationStats {
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

    public int getDiffFromPrevDay() {
        return diffFromPrevDay;
    }

    public void setDiffFromPrevDay(int diffFromPrevDay) {
        this.diffFromPrevDay = diffFromPrevDay;
    }

    public String getLat() {
        return lat;
    }

    public void setLat(String lat) {
        this.lat = lat;
    }

    public String getLon() {
        return lon;
    }

    public void setLon(String lon) {
        this.lon = lon;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public int getLatestTotalCases() {
        return latestTotalCases;
    }

    public void setLatestTotalCases(int latestTotalCases) {
        this.latestTotalCases = latestTotalCases;
    }

    public int getLatestRecoveredCases() {
        return latestRecoveredCases;
    }

    public void setLatestRecoveredCases(int latestRecoveredCases) {
        this.latestRecoveredCases = latestRecoveredCases;
    }

    public int getDiffFromPrevRecovered() {
        return diffFromPrevRecovered;
    }

    public void setDiffFromPrevRecovered(int diffFromPrevRecovered) {
        this.diffFromPrevRecovered = diffFromPrevRecovered;
    }

    public int getLastestDeathCases() {
        return lastestDeathCases;
    }

    public void setLastestDeathCases(int lastestDeathCases) {
        this.lastestDeathCases = lastestDeathCases;
    }

    public int getDiffFromPrevDeath() {
        return diffFromPrevDeath;
    }

    public void setDiffFromPrevDeath(int diffFromPrevDeath) {
        this.diffFromPrevDeath = diffFromPrevDeath;
    }

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
