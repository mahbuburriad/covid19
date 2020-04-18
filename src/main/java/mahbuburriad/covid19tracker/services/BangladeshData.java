package mahbuburriad.covid19tracker.services;

import mahbuburriad.covid19tracker.models.BangladeshStats;
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

public class BangladeshData {
    private static String bangladesh_data_url = "https://raw.githubusercontent.com/mahbuburriad/covid19-tracker/master/bangladesh.csv";

    //location stats
    private List<BangladeshStats> bstats = new ArrayList<>();

    public List<BangladeshStats> getStats() {
        return bstats;
    }

    //after get data then execute
    @PostConstruct
    //start a cron job to run this method every second
    @Scheduled(cron = "* * 1 * * *")
    public void fetchData() throws IOException, InterruptedException {
        List<BangladeshStats> newBStats = new ArrayList<>();
        //create a client called httpclient to access HTTP
        HttpClient clients = HttpClient.newHttpClient();
        //build pattern for HTTP
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(bangladesh_data_url)) //get the URI
                .build(); //set and build
        //send a request to client
        HttpResponse<String> bhttpResponse = clients.send(request, HttpResponse.BodyHandlers.ofString());
        //print the body
        System.out.println(bhttpResponse.body());

        //parse a string for reader
        StringReader csvBodyReader = new StringReader(bhttpResponse.body());
        Iterable<CSVRecord> brecords = CSVFormat.DEFAULT.withFirstRecordAsHeader().parse(csvBodyReader);


        for (CSVRecord brecord : brecords) {
            BangladeshStats bstates = new BangladeshStats();
            bstates.setDate(brecord.get("Date"));
            bstates.setInfected(brecord.get("আক্রান্ত"));
            bstates.setRecovered(brecord.get("সুস্থ"));
            bstates.setDeath(brecord.get("মৃত্যু"));
            newBStats.add(bstates);
        }
        this.bstats = newBStats;





    }
}
