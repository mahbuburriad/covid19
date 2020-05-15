package com.sgl.covid19.controllers;

import com.sgl.covid19.models.LocationStats;
import com.sgl.covid19.services.Data;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import java.util.List;
import java.text.NumberFormat;


@Controller
public class HomeController {

    @Autowired
    Data data;

    @GetMapping("/")

    public String home(Model model) {

        /**
         * This data is for Recovery stats
         */
        //for recovered section
        List<LocationStats> rStats = data.getrStats();
        //sum of all recovered data
        int totalRecoveredStat = rStats.stream().mapToInt(rStat -> rStat.getLatestRecoveredCases()).sum();
        String totalRecoveredStats = NumberFormat.getIntegerInstance().format(totalRecoveredStat);
        //sum of all previous recovered data
        int prevRecoveredStat = rStats.stream().mapToInt(rStat -> rStat.getDiffFromPrevRecovered()).sum();
        String prevRecoveredStas = NumberFormat.getIntegerInstance().format(prevRecoveredStat);
        //initialize the recovered stats as locationStats
        model.addAttribute("recovered", rStats);
        //pass totalRecovered states data to totalRecoveredStats
        model.addAttribute("totalRecoveredStats", totalRecoveredStats);
        //pass previous recovered stats data to prevRecoveredStats
        model.addAttribute("prevRecoveredStas", prevRecoveredStas);

        /**
         * This data is for death stats
         */
        //for death section
        List<LocationStats> dStats = data.getdStats();
        //sum of all death data
        int totalDeathStat = dStats.stream().mapToInt(dStat -> dStat.getLatestDeathCases()).sum();
        String totalDeathStats = NumberFormat.getIntegerInstance().format(totalDeathStat);
        //sum of all previous recovered data
        int prevDeathStat = dStats.stream().mapToInt(dStat -> dStat.getDiffFromPrevDeath()).sum();
        String prevDeathStats = NumberFormat.getIntegerInstance().format(prevDeathStat);
        //initialize the recovered stats as locationStats
        model.addAttribute("death", dStats);
        //pass total Death Stats as totalDeathStats
        model.addAttribute("totalDeathStats", totalDeathStats);
        //pass previous death stats as prevDeathStats
        model.addAttribute("prevDeathStats", prevDeathStats);

        /**
         * This data is for confirm stats
         */
        //for confirm section
        List<LocationStats> stats = data.getStats();
        //sum of all confirmed data
        int totalReportedCase = stats.stream().mapToInt(stat -> stat.getLatestTotalCases()).sum();
        String totalReportedCases = NumberFormat.getIntegerInstance().format(totalReportedCase);
        //sum of all previous confirmed data
        int totalNewCase = stats.stream().mapToInt(stat -> stat.getDiffFromPrevDay()).sum();
        String totalNewCases = NumberFormat.getIntegerInstance().format(totalNewCase);

        /**
         * find max number
         */
        //int array = stats.stream().mapToInt(stat -> stat.getLatestTotalCases()).max().orElseThrow(NoSuchElementException::new);

        //initialize the confirm stats as locationStats
        model.addAttribute("locationStats", stats);
        //pass total confirmed data as totalReportedCases
        model.addAttribute("totalReportedCases", totalReportedCases);
        //pass previous confirmed case as totalNewCases
        model.addAttribute("totalNewCases", totalNewCases);
        //model.addAttribute("array", array);


        /**
         * Active Cases
         */
        int activeCase = totalReportedCase - (totalDeathStat + totalRecoveredStat);
        String activeCases = NumberFormat.getIntegerInstance().format(activeCase);
        model.addAttribute("activeCases", activeCases);

        /**
         * last seven days record
         */
        int lastSevenDaysRecords = stats.stream().mapToInt(rStat -> rStat.getLastSevenDaysRecord()).sum();
        String lastSevenDaysRecord = NumberFormat.getIntegerInstance().format(lastSevenDaysRecords);
        model.addAttribute("lastSevenDaysRecord", lastSevenDaysRecord);

        /**
         * closed cases
         */
        int closedCase = totalRecoveredStat + totalDeathStat;
        String closedCases = NumberFormat.getIntegerInstance().format(closedCase);
        int recoveredPercentage = 100 - ((totalDeathStat * 100) / closedCase);
        int deathPercentage = 100 - ((totalRecoveredStat * 100) / closedCase) - 1;
        model.addAttribute("closedCases", closedCases);
        model.addAttribute("recoveredPercentage", recoveredPercentage);
        model.addAttribute("deathPercentage", deathPercentage);

        //return value to index.html webPage
        return "index";
    }


}
