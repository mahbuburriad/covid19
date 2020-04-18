package mahbuburriad.covid19tracker.controllers;

import mahbuburriad.covid19tracker.models.BangladeshStats;
import mahbuburriad.covid19tracker.services.BangladeshData;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

import java.util.List;

public class BangladeshController {
    @Autowired
    BangladeshData bdata;

    @GetMapping("/bangladesh")
    public String bangladesh(Model models){
        List<BangladeshStats> bstats = bdata.getStats();
        models.addAttribute("bstatss", bstats);
        return "bangladesh";
    }
}
