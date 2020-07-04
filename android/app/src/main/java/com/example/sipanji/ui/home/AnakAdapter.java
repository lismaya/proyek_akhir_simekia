package com.example.sipanji.ui.home;

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
import com.example.sipanji.ui.menu_anak.MenuAnakFragment;

import java.util.ArrayList;

public class AnakAdapter extends RecyclerView.Adapter<AnakAdapter.AnakViewHolder> {

    private ArrayList<AnakModelRecycler> dataList;

    public AnakAdapter(ArrayList<AnakModelRecycler> dataList) {
        this.dataList = dataList;
    }


    @NonNull
    @Override
    public AnakViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.recycler_anak_list, parent, false);
        return new AnakAdapter.AnakViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull AnakViewHolder holder, int position) {
        holder.tvNamalengkap.setText( String.format("%s\n%s",dataList.get(position).getNama(),dataList.get(position).getTanggal_lahir()));
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Log.i("OnClick", String.valueOf(dataList.get(position).getId()));
                Bundle bundle = new Bundle();
                bundle.putInt("pasien_id", dataList.get(position).getId());
                bundle.putString("pasien_jk", dataList.get(position).getJk());


                MenuAnakFragment fragment = new MenuAnakFragment();
                fragment.setArguments(bundle);
                AppCompatActivity activity = (AppCompatActivity) v.getContext();

                activity.getSupportFragmentManager()
                    .beginTransaction()
                    .replace(R.id.nav_host_fragment, fragment, MenuAnakFragment.class.getSimpleName())
                    .addToBackStack(null)
                    .commit();
            }
        });
    }

    @Override
    public int getItemCount() {
        return dataList.size();
    }

    public class AnakViewHolder extends RecyclerView.ViewHolder {
        TextView tvNamalengkap;

        public AnakViewHolder(View itemView) {
            super(itemView);
            tvNamalengkap = itemView.findViewById(R.id.tvAnak_nama);
        }
    }
}
