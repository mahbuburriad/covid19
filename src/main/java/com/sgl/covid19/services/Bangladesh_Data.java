package com.sgl.covid19.services;



import com.sgl.covid19.models.BangladeshStats;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;

import javax.annotation.PostConstruct;
import java.io.IOException;
import java.io.StringReader;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.ArrayList;
import java.util.List;

@Service
public class Bangladesh_Data {
    //Bangladesh Data
    private static String bangladesh_Data_URL = "https://raw.githubusercontent.com/mahbuburriad/covid19-tracker/master/bangladesh_data/bangladesh.csv?token=AJWHTIP3FR3EAKTIZIYRTVK6VSYH4";

    //for bangladeshi data
    private List<BangladeshStats> stats = new ArrayList<>();

    public List<BangladeshStats> getStats() {
        return stats;
    }

    //after get data then execute
    @PostConstruct
    //start a cron job to run this method every second
    @Scheduled(cron = "* * * * * *")
    public void fetchData() throws IOException, InterruptedException {
        //array list for Bangladesh Data stats stats
        List<BangladeshStats> newStats = new ArrayList<>();

        //create a client called httpclient to access HTTP
        HttpClient client = HttpClient.newHttpClient();
        //build pattern for HTTP
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(bangladesh_Data_URL)) //get the URI
                .build(); //set and build
        //send a request to client
        HttpResponse<String> httpResponse = client.send(request, HttpResponse.BodyHandlers.ofString());
        //print the body
        System.out.println(httpResponse.body());

        //parse a string for reader
        StringReader csvBodyReader = new StringReader(httpResponse.body());
        Iterable<CSVRecord> records = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReader);

        //get data from Data table for confirmed section
        for (CSVRecord record : records) {
            BangladeshStats bangladeshStats = new BangladeshStats();
            bangladeshStats.setDate(record.get("Date"));
            bangladeshStats.setTotal_cases(Integer.parseInt(record.get("Total Cases")));
            System.out.println(bangladeshStats); //print all value to console
            newStats.add(bangladeshStats);
        }
        this.stats = newStats; //initialize the stats

    }
}
