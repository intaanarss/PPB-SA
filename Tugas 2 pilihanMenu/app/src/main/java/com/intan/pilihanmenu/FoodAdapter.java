package com.intan.pilihanmenu;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.intan.pilihanmenu.databinding.ItemListLayoutBinding;

import java.util.ArrayList;

public class FoodAdapter extends RecyclerView.Adapter<FoodAdapter.ViewHolder> {
    public ArrayList<DataFood> foodList = new ArrayList<>();

    public FoodAdapter(ArrayList<DataFood> foodList) {
        this.foodList = foodList;
    }

    @NonNull
    @Override
    public FoodAdapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        return new ViewHolder(ItemListLayoutBinding.inflate(LayoutInflater.from(parent.getContext()), parent, false));
    }

    @Override
    public void onBindViewHolder(@NonNull FoodAdapter.ViewHolder holder, int position) {
        DataFood food = foodList.get(position);
        holder.setItem(food);



        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent iDetail = new Intent(holder.itemView.getContext(), DetailActivity.class);
                iDetail.putExtra("image", food.image);
                iDetail.putExtra("name", food.name);
                iDetail.putExtra("status", food.status);
                iDetail.putExtra("price", food.price);
                iDetail.putExtra("desc", food.desc);
                holder.itemView.getContext().startActivity(iDetail);
            }
        });
    }

    @Override
    public int getItemCount() {
        return foodList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        ItemListLayoutBinding binding;

        public ViewHolder(@NonNull ItemListLayoutBinding b) {
            super(b.getRoot());
            binding = b;
        }

        public void setItem(DataFood food) {
            binding.ivFood.setImageResource(food.image);
            binding.tvFoodName.setText(food.name);
            binding.tvKeterangan.setText(food.status);

            binding.tvHarga.setText(new StringBuilder("Rp " + food.price));
        }
    }
}