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

public class RiwayatImunisasiAdapter extends RecyclerView.Adapter<RiwayatImunisasiAdapter.RiwayatImunisasiViewHolder> {
    private ArrayList<RiwayatImunisasiModelRecycler> dataList;

    public RiwayatImunisasiAdapter(ArrayList<RiwayatImunisasiModelRecycler> dataList) {
        this.dataList = dataList;
    }

    @NonNull
    @Override
    public RiwayatImunisasiAdapter.RiwayatImunisasiViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.recycler_riwayat_imunisasi_list, parent, false);
        return new RiwayatImunisasiAdapter.RiwayatImunisasiViewHolder(view);
    }


    @Override
    public void onBindViewHolder(@NonNull RiwayatImunisasiAdapter.RiwayatImunisasiViewHolder holder, int position) {
        holder.tvTgl.setText(dataList.get(position).getTgl());
        holder.tvJenis.setText( String.format("Imunisasi %s", dataList.get(position).getJenis()));

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

    public class RiwayatImunisasiViewHolder extends RecyclerView.ViewHolder {
        TextView tvTgl,tvJenis;

        public RiwayatImunisasiViewHolder(View itemView) {
            super(itemView);
            tvTgl = itemView.findViewById(R.id.listRiwayatImunisasi_tvTanggal);
            tvJenis = itemView.findViewById(R.id.listRiwayatImunisasi_tvJenis);
        }
    }

}
