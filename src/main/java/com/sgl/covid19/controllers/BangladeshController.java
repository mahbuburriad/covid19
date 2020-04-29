package com.sgl.covid19.controllers;
import com.sgl.covid19.models.BangladeshStats;
import com.sgl.covid19.services.Bangladesh_Data;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import java.util.List;

@Controller
public class BangladeshController {
    @Autowired
    Bangladesh_Data bangladesh_data;

    @GetMapping("/bangladesh")
    public String bangladesh(Model model){
        List<BangladeshStats> bstats = bangladesh_data.getStats();
        model.addAttribute("bstats", bstats);
        return "bangladesh";
    }


}
