package com.intan.pilihanmenu;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

import com.intan.pilihanmenu.databinding.ActivityOrderBinding;

public class OrderActivity extends AppCompatActivity {
    ActivityOrderBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityOrderBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        String name = getIntent().getStringExtra("name");
        String price = getIntent().getStringExtra("price");
        int qty = getIntent().getIntExtra("qty", 0);
        int pricePlus = getIntent().getIntExtra("total", 0);

        binding.tvFoodName.setText(name);
        binding.tvPrice.setText(new StringBuilder("Rp " + price));
        binding.tvQty.setText(new StringBuilder("X " + qty));
        binding.tvTotal.setText(new StringBuilder("Rp " + pricePlus));
    }
}