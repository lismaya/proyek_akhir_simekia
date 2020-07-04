package com.example.sipanji.ui.riwayat;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.viewpager.widget.ViewPager;

import com.example.sipanji.MainActivity;
import com.example.sipanji.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.tabs.TabLayout;

import butterknife.ButterKnife;

public class RiwayatFragment extends Fragment {

    private Context context;
    private int pasien_id;

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        this.context = context;
    }

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {

        View root = inflater.inflate(R.layout.fragment_riwayat, container, false);
        ButterKnife.bind(this, root);


        Bundle arguments = getArguments();
        if (arguments == null)
            Toast.makeText(getActivity(), "Arguments is NULL", Toast.LENGTH_LONG).show();
        else {
            pasien_id = getArguments().getInt("pasien_id", 0);
        }

        Toolbar toolbar = getActivity().findViewById(R.id.toolbar);
        toolbar.setTitle("Menu Pemeriksaan");
        FloatingActionButton floatingActionButton = ((MainActivity) getActivity()).getFloatingActionButton();
        if (floatingActionButton != null) {
            floatingActionButton.hide();
        }

        RiwayatTabsPagerAdapter riwayatTabsPagerAdapter = new RiwayatTabsPagerAdapter(this.pasien_id, this.context,getActivity().getSupportFragmentManager());

        ViewPager viewPager = root.findViewById(R.id.view_pager);
        viewPager.setAdapter(riwayatTabsPagerAdapter);

        TabLayout tabs = root.findViewById(R.id.tabs);
        viewPager.setOffscreenPageLimit(2);
        tabs.setupWithViewPager(viewPager);


        return root;

    }

}
