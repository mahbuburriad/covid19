package mahbuburriad.covid19tracker.controllers;

import mahbuburriad.covid19tracker.models.LocationStats;
import mahbuburriad.covid19tracker.services.Data;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import java.util.List;

@Controller
public class HomeController {

    @Autowired
    Data data;

    @GetMapping("/")
    public String home(Model model){
        //for recovered section
        List<LocationStats> rStats = data.getrStats();
        //sum of all recovered data
        int totalRecoveredStats = rStats.stream().mapToInt(rStat-> rStat.getLatestRecoveredCases()).sum();
        //sum of all previous recovered data
        int prevRecoveredStas = rStats.stream().mapToInt(rStat -> rStat.getDiffFromPrevRecovered()).sum();
        //initialize the recovered stats as locationStats
        model.addAttribute("locationStats", rStats);
        //pass totalRecovered states data to totalRecoveredStats
        model.addAttribute("totalRecoveredStats", totalRecoveredStats);
        //pass previous recovered stats data to prevRecoveredStats
        model.addAttribute("prevRecoveredStas", prevRecoveredStas);

        //for death section
        List<LocationStats> dStats = data.getdStats();
        //sum of all death data
        int totalDeathStats = dStats.stream().mapToInt(dStat -> dStat.getLastestDeathCases()).sum();
        //sum of all previous recovered data
        int prevDeathStats = dStats.stream().mapToInt(dStat -> dStat.getDiffFromPrevDeath()).sum();
        //initialize the recovered stats as locationStats
        model.addAttribute("locationStats", dStats);
        //pass total Death Stats as totalDeathStats
        model.addAttribute("totalDeathStats", totalDeathStats);
        //pass previous death stats as prevDeathStats
        model.addAttribute("prevDeathStats", prevDeathStats);

        //for confirm section
        List<LocationStats> stats = data.getStats();
        //sum of all confirmed data
        int totalReportedCases = stats.stream().mapToInt(stat -> stat.getLatestTotalCases()).sum();
        //sum of all previous confirmed data
        int totalNewCases = stats.stream().mapToInt(stat -> stat.getDiffFromPrevDay()).sum();
        //initialize the confirm stats as locationStats
        model.addAttribute("locationStats", stats);
        //pass total confirmed data as totalReportedCases
        model.addAttribute("totalReportedCases", totalReportedCases);
        //pass previous confirmed case as totalNewCases
        model.addAttribute("totalNewCases", totalNewCases);

        //return value to index.html webPage
        return "index";
    }
}
