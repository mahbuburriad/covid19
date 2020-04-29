package com.sgl.covid19.models;

public class BangladeshStats {
    private String date;
    private int total_cases;
    private int new_cases;
    private int total_death;
    private int new_death;
    private int total_recovery;
    private int new_recovery;


    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getTotal_cases() {
        return total_cases;
    }

    public void setTotal_cases(int total_cases) {
        this.total_cases = total_cases;
    }

    public int getNew_cases() {
        return new_cases;
    }

    public void setNew_cases(int new_cases) {
        this.new_cases = new_cases;
    }

    public int getTotal_death() {
        return total_death;
    }

    public void setTotal_death(int total_death) {
        this.total_death = total_death;
    }

    public int getNew_death() {
        return new_death;
    }

    public void setNew_death(int new_death) {
        this.new_death = new_death;
    }

    public int getTotal_recovery() {
        return total_recovery;
    }

    public void setTotal_recovery(int total_recovery) {
        this.total_recovery = total_recovery;
    }

    public int getNew_recovery() {
        return new_recovery;
    }

    public void setNew_recovery(int new_recovery) {
        this.new_recovery = new_recovery;
    }

    @Override
    public String toString() {
        return "BangladeshStats{" +
                "date='" + date + '\'' +
                ", total_cases=" + total_cases +
                ", new_cases=" + new_cases +
                ", total_death=" + total_death +
                ", new_death=" + new_death +
                ", total_recovery=" + total_recovery +
                ", new_recovery=" + new_recovery +
                '}';
    }
}
