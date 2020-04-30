package com.sgl.covid19.models;

public class BangladeshStats {
    private String date;
    private String total_cases;
    private String recovered;
    private String death;


    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTotal_cases() {
        return total_cases;
    }

    public void setTotal_cases(String total_cases) {
        this.total_cases = total_cases;
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
                ", total_cases='" + total_cases + '\'' +
                ", recovered='" + recovered + '\'' +
                ", death='" + death + '\'' +
                '}';
    }
}
