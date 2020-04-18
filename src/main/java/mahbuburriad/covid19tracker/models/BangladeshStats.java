package mahbuburriad.covid19tracker.models;

public class BangladeshStats {
    private String date;
    private String infected;
    private String recovered;
    private String death;

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getInfected() {
        return infected;
    }

    public void setInfected(String infected) {
        this.infected = infected;
    }

    public String getRecovered() {
        return recovered;
    }

    public void setRecovered(String recovered) {
        this.recovered = recovered;
    }

    public String getDeath() {
        return death;
    }

    public void setDeath(String death) {
        this.death = death;
    }

    @Override
    public String toString() {
        return "BangladeshStats{" +
                "date='" + date + '\'' +
                ", infected='" + infected + '\'' +
                ", recovered='" + recovered + '\'' +
                ", death='" + death + '\'' +
                '}';
    }
}
