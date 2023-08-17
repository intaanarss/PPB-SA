package com.intan.pilihanmenu;

import android.os.Parcelable;

import androidx.annotation.NonNull;

import java.util.ArrayList;
import java.util.stream.Stream;

public class DataFood extends ArrayList<Parcelable> {
    public int image;
    public String name;
    public String status;
    public String rating;
    public String price;
    public String desc;

    @NonNull
    @Override
    public Stream<Parcelable> stream() {return super.stream();
    }
}
