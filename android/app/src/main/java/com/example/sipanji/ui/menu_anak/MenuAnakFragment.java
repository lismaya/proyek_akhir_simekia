package com.example.sipanji.ui.menu_anak;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.GridLayout;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.Fragment;

import com.example.sipanji.MainActivity;
import com.example.sipanji.R;
import com.example.sipanji.ui.jadwal_imunisasi.JadwalImunisaiFragment;
import com.example.sipanji.ui.perkembangan_anak.PerkembanganAnakFragment;
import com.example.sipanji.ui.riwayat.RiwayatFragment;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;

public class MenuAnakFragment extends Fragment {

    GridLayout mainGrid;
    @BindView(R.id.menu_antrian)
    CardView menuAntrian;
    @BindView(R.id.menu_perkembangan)
    CardView menuPerkembangan;
    @BindView(R.id.menu_jadwal_imunisasi)
    CardView menuJadwalImunisasi;
    @BindView(R.id.menu_riwayat_pemeriksaan)
    CardView menuRiwayatPemeriksaan;
    private Context context;
    private int pasien_id;
    private String pasien_jk;


    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        this.context = context;
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {

        View root = inflater.inflate(R.layout.fragment_menu_anak, container, false);
        ButterKnife.bind(this, root);


        Bundle arguments = getArguments();
        if (arguments == null)
            Toast.makeText(getActivity(), "Arguments is NULL", Toast.LENGTH_LONG).show();
        else {
            pasien_id = getArguments().getInt("pasien_id", 0);
            pasien_jk = getArguments().getString("pasien_jk", "");
        }

        Toolbar toolbar = getActivity().findViewById(R.id.toolbar);
        toolbar.setTitle("Menu Pemeriksaan");
        FloatingActionButton floatingActionButton = ((MainActivity) getActivity()).getFloatingActionButton();
        if (floatingActionButton != null) {
            floatingActionButton.hide();
        }

        return root;

    }


    @OnClick(R.id.menu_antrian)
    public void onMenuAntrianClicked() {
    }

    @OnClick(R.id.menu_perkembangan)
    public void onMenuPerkembanganClicked() {
        Bundle bundle = new Bundle();
        bundle.putInt("pasien_id", this.pasien_id);
        bundle.putString("pasien_jk", this.pasien_jk);

        PerkembanganAnakFragment fragment = new PerkembanganAnakFragment();
        fragment.setArguments(bundle);
        AppCompatActivity activity = (AppCompatActivity) getView().getContext();

        activity.getSupportFragmentManager()
            .beginTransaction()
            .replace(R.id.nav_host_fragment, fragment, PerkembanganAnakFragment.class.getSimpleName())
            .addToBackStack(null)
            .commit();
    }

    @OnClick(R.id.menu_jadwal_imunisasi)
    public void onMenuJadwalImunisasiClicked() {

        Bundle bundle = new Bundle();
        bundle.putInt("pasien_id", this.pasien_id);

        JadwalImunisaiFragment fragment = new JadwalImunisaiFragment();
        fragment.setArguments(bundle);
        AppCompatActivity activity = (AppCompatActivity) getView().getContext();

        activity.getSupportFragmentManager()
            .beginTransaction()
            .replace(R.id.nav_host_fragment, fragment, JadwalImunisaiFragment.class.getSimpleName())
            .addToBackStack(null)
            .commit();
    }

    @OnClick(R.id.menu_riwayat_pemeriksaan)
    public void onMenuRiwayatPemeriksaanClicked() {

        Bundle bundle = new Bundle();
        bundle.putInt("pasien_id", this.pasien_id);

        RiwayatFragment fragment = new RiwayatFragment();
        fragment.setArguments(bundle);
        AppCompatActivity activity = (AppCompatActivity) getView().getContext();

        activity.getSupportFragmentManager()
            .beginTransaction()
            .replace(R.id.nav_host_fragment, fragment, RiwayatFragment.class.getSimpleName())
            .addToBackStack(null)
            .commit();
    }
}
