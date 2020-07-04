package com.example.sipanji.ui.riwayat;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import com.example.sipanji.R;
import com.example.sipanji.ui.home.AnakAdapter;
import com.example.sipanji.ui.home.AnakModelRecycler;
import com.example.sipanji.ui.menu_anak.MenuAnakFragment;

import java.util.ArrayList;

public class RiwayatPemeriksaanAdapter extends RecyclerView.Adapter<RiwayatPemeriksaanAdapter.RiwayatPemeriksaanViewHolder> {
    private ArrayList<RiwayatPemeriksaanModelRecycler> dataList;

    public RiwayatPemeriksaanAdapter(ArrayList<RiwayatPemeriksaanModelRecycler> dataList) {
        this.dataList = dataList;
    }

    @NonNull
    @Override
    public RiwayatPemeriksaanAdapter.RiwayatPemeriksaanViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.recycler_riwayat_pemeriksaan_list, parent, false);
        return new RiwayatPemeriksaanAdapter.RiwayatPemeriksaanViewHolder(view);
    }


    @Override
    public void onBindViewHolder(@NonNull RiwayatPemeriksaanAdapter.RiwayatPemeriksaanViewHolder holder, int position) {
        holder.tvTgl.setText(dataList.get(position).getTgl());
        holder.tvJenis.setText( String.format("Pemeriksaan %s", dataList.get(position).getJenis()));

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Log.i("OnClick", String.valueOf(dataList.get(position).getId()));

            }
        });
    }

    @Override
    public int getItemCount() {
        return dataList.size();
    }

    public class RiwayatPemeriksaanViewHolder extends RecyclerView.ViewHolder {
        TextView tvTgl,tvJenis;

        public RiwayatPemeriksaanViewHolder(View itemView) {
            super(itemView);
            tvTgl = itemView.findViewById(R.id.listRiwayatPemeriksaan_tvTanggal);
            tvJenis = itemView.findViewById(R.id.listRiwayatPemeriksaan_tvJenis);
        }
    }

}
