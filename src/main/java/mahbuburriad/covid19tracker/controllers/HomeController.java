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
        List<LocationStats> rStats = data.getrStats();
        int totalRecoveredStats = rStats.stream().mapToInt(rStat-> rStat.getLatestRecoveredCases()).sum();
        int prevRecoveredStas = rStats.stream().mapToInt(rStat -> rStat.getDiffFromPrevRecovered()).sum();
        model.addAttribute("locationStats", rStats);
        model.addAttribute("totalRecoveredStats", totalRecoveredStats);
        model.addAttribute("prevRecoveredStas", prevRecoveredStas);

        List<LocationStats> dStats = data.getdStats();
        int totalDeathStats = dStats.stream().mapToInt(dStat -> dStat.getLastestDeathCases()).sum();
        int prevDeathStats = dStats.stream().mapToInt(dStat -> dStat.getDiffFromPrevDeath()).sum();
        model.addAttribute("locationStats", dStats);
        model.addAttribute("totalDeathStats", totalDeathStats);
        model.addAttribute("prevDeathStats", prevDeathStats);


        List<LocationStats> stats = data.getStats();
        int totalReportedCases = stats.stream().mapToInt(stat -> stat.getLatestTotalCases()).sum();
        int totalNewCases = stats.stream().mapToInt(stat -> stat.getDiffFromPrevDay()).sum();
        model.addAttribute("locationStats", stats);
        model.addAttribute("totalReportedCases", totalReportedCases);
        model.addAttribute("totalNewCases", totalNewCases);


        return "index";
    }
}
