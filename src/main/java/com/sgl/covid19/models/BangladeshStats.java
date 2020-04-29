package com.sgl.covid19.models;

public class BangladeshStats {
    private String date;
    private String total_cases;

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

    @Override
    public String toString() {
        return "BangladeshStats{" +
                "date='" + date + '\'' +
                ", total_cases='" + total_cases + '\'' +
                '}';
    }
}
