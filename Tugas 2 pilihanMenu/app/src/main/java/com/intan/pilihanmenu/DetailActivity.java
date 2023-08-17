package com.intan.pilihanmenu;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import com.intan.pilihanmenu.databinding.ActivityDetailBinding;

public class DetailActivity extends AppCompatActivity {
    ActivityDetailBinding binding;
    int quantity = 1;


    int pricePlus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityDetailBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        int image = getIntent().getIntExtra("image", 0);
        String name = getIntent().getStringExtra("name");
        String desc = getIntent().getStringExtra("desc");
        String price = getIntent().getStringExtra("price");
        pricePlus = Integer.parseInt(price);

        binding.ivFood.setImageResource(image);
        binding.tvFoodName.setText(name);
        binding.tvDesc.setText(desc);
        binding.btnBuy.setText(new StringBuilder("Rp " + price));
        binding.tvQty.setText(String.valueOf(quantity));

        binding.removeBtn.setOnClickListener(view -> {
            pricePlus = Integer.parseInt(price);
            quantity -= 1;
            binding.tvQty.setText(String.valueOf(quantity));
            pricePlus *= quantity;
            binding.btnBuy.setText(new StringBuilder("Rp " + pricePlus));
        });

        binding.plusBtn.setOnClickListener(view -> {
            pricePlus = Integer.parseInt(price);
            quantity += 1;
            binding.tvQty.setText(String.valueOf(quantity));
            pricePlus *= quantity;
            binding.btnBuy.setText(new StringBuilder("Rp " + pricePlus));
        });

        binding.btnBuy.setOnClickListener(view -> {
            Intent iOrder = new Intent(DetailActivity.this, OrderActivity.class);
            iOrder.putExtra("name", name);
            iOrder.putExtra("qty", quantity);
            iOrder.putExtra("price", price);
            iOrder.putExtra("total", pricePlus);
            startActivity(iOrder);
        });
    }
}