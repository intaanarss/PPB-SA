package com.intan.restotan;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;

public class MainActivity extends AppCompatActivity {

    ImageButton btnTelefon;
    ImageButton btnEmail;
    ImageButton btnMap;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btnTelefon = findViewById(R.id.btn_telefon);
        btnEmail = findViewById(R.id.btn_email);
        btnMap = findViewById(R.id.btn_map);


        btnTelefon.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String nomor="081231442341";
                Intent memanggil = new Intent(Intent.ACTION_DIAL);
                memanggil.setData(Uri.fromParts("tel", nomor, null ));
                startActivity(memanggil);
            }
        });

        btnMap.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Uri gmmIntentUri = Uri.parse("geo:-7.055936, 110.436124?q=Udinus");
                Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
                mapIntent.setPackage("com.google.android.apps.maps");
                startActivity(mapIntent);

            }
        });

        btnEmail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Intent.ACTION_SEND);
                intent.setType("text/plain");
                intent.putExtra(Intent.EXTRA_SUBJECT, "Tanya seputar resto");
                intent.putExtra(Intent.EXTRA_TEXT, "Hai, ini adalah percobaan mengirim email dari aplikasi android");

                try {
                    startActivity(Intent.createChooser(intent, "Ingin Mengirim Email ?"));
                } catch (android.content.ActivityNotFoundException ex) {
                    //do something else
                }
            }
        });


    }

}