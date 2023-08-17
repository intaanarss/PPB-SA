package com.intan.pilihanmenu;


import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.content.res.TypedArray;
import android.os.Bundle;
import android.view.Menu;

import com.intan.pilihanmenu.databinding.ActivityMainBinding;

import java.util.ArrayList;


public class MainActivity extends AppCompatActivity {
    ActivityMainBinding binding;

    TypedArray dataImage;
    TypedArray dataName;
    TypedArray dataStatus;
    TypedArray dataPrice;
    TypedArray dataDesc;
    ArrayList<DataFood> foodList = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityMainBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        setResources();

        FoodAdapter adapter = new FoodAdapter(addItem());

        binding.rvList.setLayoutManager(new LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false));

        binding.rvList.setAdapter(adapter);
    }

    private void setResources() {
        dataImage = getResources().obtainTypedArray(R.array.image);
        dataName = getResources().obtainTypedArray(R.array.name);
        dataStatus = getResources().obtainTypedArray(R.array.status);
        dataPrice = getResources().obtainTypedArray(R.array.price);
        dataDesc = getResources().obtainTypedArray(R.array.desc);
    }

    private ArrayList<DataFood> addItem() {
        foodList = new ArrayList<>();
        for (int i = 0; i < dataName.length(); i++) {
            DataFood food = new DataFood();
            food.image = dataImage.getResourceId(i, -1);
            food.name = dataName.getString(i);
            food.status = dataStatus.getString(i);

            food.price = dataPrice.getString(i);
            food.desc = dataDesc.getString(i);
            foodList.add(food);
        }
        return foodList;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        return super.onCreateOptionsMenu(menu);
    }
}