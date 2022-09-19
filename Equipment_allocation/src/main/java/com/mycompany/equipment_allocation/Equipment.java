/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
package com.mycompany.equipment_allocation;


import java.awt.Component;
import java.awt.Desktop;
import java.awt.Frame;
import java.io.BufferedOutputStream;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Calendar;
import java.util.Vector;
import static javax.management.Query.lt;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.RowFilter;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import javax.swing.table.TableRowSorter;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFCell;
import org.apache.poi.xssf.usermodel.XSSFRow;
import org.apache.poi.xssf.usermodel.XSSFSheet;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

/**
 *
 * @author ManiVas
 */
public class Equipment extends javax.swing.JFrame {

    /**
     * Creates new form Equipment
     */
    Connection conn = null;
    Statement stmt = null;
    PreparedStatement pst;
    

    public Equipment() {
        initComponents();
        Connect();
        table_update();
        //  DateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy");
//   Date date = new Date();
//   System.out.println(dateFormat.format(date));
//   txt_date.setText(dateFormat.format(date));
        LocalDate date = LocalDate.now();
        String formattedDate = date.format(DateTimeFormatter.ofPattern("dd-MM-yyyy"));
        txt_date.setText("" + formattedDate);
    }

    public void Connect() {

        try {

            String dbURL = "jdbc:sqlserver://192.168.200.64\\SQLEXPRESS;databaseName=OMC;encrypt=true;trustServerCertificate=true;";
            String user = "test";
            String pass = "1234";
            conn = DriverManager.getConnection(dbURL, user, pass);

        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }

    private void table_update() {
        try {
            int c;
            try {
                pst = conn.prepareStatement("Select * from allocation2 ORDER BY date DESC;");
                ResultSet rs = pst.executeQuery();
                ResultSetMetaData rsd = rs.getMetaData();
                c = rsd.getColumnCount();
                DefaultTableModel d = (DefaultTableModel) jTable1.getModel();
                d.setRowCount(0);

                while (rs.next()) {
                    Vector v2 = new Vector();

                    for (int i = 1; i <= c; i++) {
                        v2.add(rs.getString("id"));
                        v2.add(rs.getString("name"));
                        v2.add(rs.getString("shift"));
                        v2.add(rs.getString("equipment"));
                        v2.add(rs.getString("equipmentnumber"));
                        v2.add(rs.getString("location"));
                        v2.add(rs.getString("sub_location"));
                        v2.add(rs.getString("type"));
                        v2.add(rs.getString("date"));
                    }
                    d.addRow(v2);
                }

            } catch (Exception ex) {

                ex.printStackTrace();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
//                public class ExcelExporter {
//    ExcelExporter(){}
//    public void exportTable(JTable jTable1,File file) throws IOException{
//      FileWriter out=new FileWriter(file);
//      BufferedWriter bw=new BufferedWriter(out);
//      for (int i=0;i<jTable1.getColumnCount();i++){
//        bw.write(jTable1.getColumnName(i)+"\t");
//      }
//      bw.write("\n");
//      for (int i=0;i<jTable1.getRowCount();i++){
//        for (int j=0;j<jTable1.getColumnCount();j++){
//          bw.write(jTable1.getValueAt(i,j).toString()+"\t");
//        }
//        bw.write("\n");
//      }
//      bw.close();
//   System.out.print("Write out to"+file);
//
//
//}
//}

    public void openFile(String file) {
        try {
            File path = new File(file);
            Desktop.getDesktop().open(path);
        } catch (IOException ioe) {
            System.out.println(ioe);
        }
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jButton1 = new javax.swing.JButton();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        txt_date = new javax.swing.JTextField();
        jLabel3 = new javax.swing.JLabel();
        txt_name = new javax.swing.JTextField();
        jLabel4 = new javax.swing.JLabel();
        jLabel5 = new javax.swing.JLabel();
        txt_id = new javax.swing.JTextField();
        combo_equipment = new javax.swing.JComboBox<>();
        jLabel6 = new javax.swing.JLabel();
        combo_location = new javax.swing.JComboBox<>();
        jLabel7 = new javax.swing.JLabel();
        combo_sublocation = new javax.swing.JComboBox<>();
        jLabel8 = new javax.swing.JLabel();
        combo_type = new javax.swing.JComboBox<>();
        jLabel9 = new javax.swing.JLabel();
        combo_shift = new javax.swing.JComboBox<>();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTable1 = new javax.swing.JTable();
        jLabel10 = new javax.swing.JLabel();
        txt_filter = new javax.swing.JTextField();
        btn_export = new javax.swing.JButton();
        jLabel11 = new javax.swing.JLabel();
        jLabel12 = new javax.swing.JLabel();
        jPanel1 = new javax.swing.JPanel();
        btn_submit = new javax.swing.JButton();
        btn_exit = new javax.swing.JButton();
        btn_reset = new javax.swing.JButton();
        jLabel13 = new javax.swing.JLabel();
        combo_equipmentnumber = new javax.swing.JComboBox<>();

        jButton1.setText("jButton1");

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setTitle("EQUIPMENTS ALLOCATION SYSTEM");
        setBackground(new java.awt.Color(255, 255, 204));
        getContentPane().setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        jLabel1.setFont(new java.awt.Font("Segoe UI", 1, 36)); // NOI18N
        jLabel1.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel1.setText("KODINGAMALI BAUXITE MINES");
        jLabel1.setToolTipText("");
        getContentPane().add(jLabel1, new org.netbeans.lib.awtextra.AbsoluteConstraints(510, 10, 580, -1));

        jLabel2.setText("Date");
        getContentPane().add(jLabel2, new org.netbeans.lib.awtextra.AbsoluteConstraints(1053, 62, -1, -1));

        txt_date.setEditable(false);
        getContentPane().add(txt_date, new org.netbeans.lib.awtextra.AbsoluteConstraints(1104, 59, 100, -1));

        jLabel3.setText("Operator ID");
        getContentPane().add(jLabel3, new org.netbeans.lib.awtextra.AbsoluteConstraints(29, 146, 91, -1));

        txt_name.setEditable(false);
        getContentPane().add(txt_name, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 198, 190, -1));

        jLabel4.setText("Equipment");
        getContentPane().add(jLabel4, new org.netbeans.lib.awtextra.AbsoluteConstraints(29, 322, 82, -1));

        jLabel5.setText("Operator Name");
        getContentPane().add(jLabel5, new org.netbeans.lib.awtextra.AbsoluteConstraints(29, 198, -1, -1));

        txt_id.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                txt_idActionPerformed(evt);
            }
        });
        txt_id.addPropertyChangeListener(new java.beans.PropertyChangeListener() {
            public void propertyChange(java.beans.PropertyChangeEvent evt) {
                txt_idPropertyChange(evt);
            }
        });
        getContentPane().add(txt_id, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 146, 190, -1));

        combo_equipment.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Select Equipment", "Tipper", "Excavator", "Drilling Machine", "Dozer", "Grader", "Loader" }));
        combo_equipment.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combo_equipmentActionPerformed(evt);
            }
        });
        getContentPane().add(combo_equipment, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 319, 190, -1));

        jLabel6.setText("Main Location");
        getContentPane().add(jLabel6, new org.netbeans.lib.awtextra.AbsoluteConstraints(30, 450, 82, -1));

        combo_location.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Select Location", "Mines", "Crusher" }));
        combo_location.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combo_locationActionPerformed(evt);
            }
        });
        getContentPane().add(combo_location, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 450, 190, -1));

        jLabel7.setText("Sub Location");
        getContentPane().add(jLabel7, new org.netbeans.lib.awtextra.AbsoluteConstraints(30, 510, 82, -1));

        combo_sublocation.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combo_sublocationActionPerformed(evt);
            }
        });
        getContentPane().add(combo_sublocation, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 510, 190, -1));

        jLabel8.setText("Material Type");
        getContentPane().add(jLabel8, new org.netbeans.lib.awtextra.AbsoluteConstraints(30, 580, 82, -1));

        combo_type.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Select Material Type", "Topsoil", "OB", "ROM", "Crushed Ore" }));
        getContentPane().add(combo_type, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 580, 190, -1));

        jLabel9.setText("Shift");
        getContentPane().add(jLabel9, new org.netbeans.lib.awtextra.AbsoluteConstraints(29, 258, 91, -1));

        combo_shift.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Select Shift", "A Shift", "B Shift", "C Shift" }));
        combo_shift.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combo_shiftActionPerformed(evt);
            }
        });
        getContentPane().add(combo_shift, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 258, 190, -1));

        jTable1.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null, null, null, null, null, null},
                {null, null, null, null, null, null, null, null, null},
                {null, null, null, null, null, null, null, null, null},
                {null, null, null, null, null, null, null, null, null}
            },
            new String [] {
                "ID", "Name", "Shift", "Equipment", "Equipment No.", "Location", "Sub Location", "Material Type", "Date"
            }
        ) {
            Class[] types = new Class [] {
                java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class, java.lang.String.class
            };

            public Class getColumnClass(int columnIndex) {
                return types [columnIndex];
            }
        });
        jScrollPane1.setViewportView(jTable1);

        getContentPane().add(jScrollPane1, new org.netbeans.lib.awtextra.AbsoluteConstraints(379, 121, 890, 500));

        jLabel10.setText("Filter");
        getContentPane().add(jLabel10, new org.netbeans.lib.awtextra.AbsoluteConstraints(631, 90, -1, -1));

        txt_filter.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                txt_filterActionPerformed(evt);
            }
        });
        getContentPane().add(txt_filter, new org.netbeans.lib.awtextra.AbsoluteConstraints(700, 87, 123, -1));

        btn_export.setText("Export");
        btn_export.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btn_exportActionPerformed(evt);
            }
        });
        getContentPane().add(btn_export, new org.netbeans.lib.awtextra.AbsoluteConstraints(873, 87, 95, -1));
        getContentPane().add(jLabel11, new org.netbeans.lib.awtextra.AbsoluteConstraints(119, 6, -1, -1));

        jLabel12.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Images/omc.png"))); // NOI18N
        getContentPane().add(jLabel12, new org.netbeans.lib.awtextra.AbsoluteConstraints(28, 6, 369, 93));

        btn_submit.setText("Submit");
        btn_submit.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btn_submitActionPerformed(evt);
            }
        });
        jPanel1.add(btn_submit);

        btn_exit.setText("Exit");
        btn_exit.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btn_exitActionPerformed(evt);
            }
        });
        jPanel1.add(btn_exit);

        btn_reset.setText("Reset");
        btn_reset.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btn_resetActionPerformed(evt);
            }
        });
        jPanel1.add(btn_reset);

        getContentPane().add(jPanel1, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 650, 360, 40));

        jLabel13.setText("Equipment number");
        getContentPane().add(jLabel13, new org.netbeans.lib.awtextra.AbsoluteConstraints(30, 380, 130, -1));

        combo_equipmentnumber.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { " " }));
        combo_equipmentnumber.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                combo_equipmentnumberActionPerformed(evt);
            }
        });
        getContentPane().add(combo_equipmentnumber, new org.netbeans.lib.awtextra.AbsoluteConstraints(160, 380, 190, -1));

        pack();
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents

    private void combo_equipmentActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combo_equipmentActionPerformed
        // TODO add your handling code here:
        
           if (combo_equipment.getSelectedItem().equals("Tipper")) {
            combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("TIPPER FMX460-1");
             combo_equipmentnumber.addItem("TIPPER FMX460-2");
             combo_equipmentnumber.addItem("TIPPER FMX460-3");
             combo_equipmentnumber.addItem("TIPPER FMX460-4");
             combo_equipmentnumber.addItem("TIPPER FMX460-5");
             combo_equipmentnumber.addItem("TIPPER FMX460-6");
             combo_equipmentnumber.addItem("TIPPER FMX460-7");
                    combo_equipmentnumber.addItem("TIPPER FMX460-8");
                     combo_equipmentnumber.addItem("TIPPER FMX460-9");
                      combo_equipmentnumber.addItem("TIPPER FMX460-10");
                       combo_equipmentnumber.addItem("TIPPER FMX460-11");
                        combo_equipmentnumber.addItem("TIPPER FMX460-12");
                         combo_equipmentnumber.addItem("TIPPER FMX460-13");
                          combo_equipmentnumber.addItem("TIPPER FMX460-14");
                           combo_equipmentnumber.addItem("TIPPER FMX460-15");
                            combo_equipmentnumber.addItem("TIPPER FMX460-16");
                             combo_equipmentnumber.addItem("TIPPER FMX460-17");
                              combo_equipmentnumber.addItem("TIPPER FMX460-18");
                      
                 
        } else if (combo_equipment.getSelectedItem().equals("Excavator")) {
             combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("EXCAVATOR-480(31)");
             combo_equipmentnumber.addItem("EXCAVATOR-480(32)");
             combo_equipmentnumber.addItem("EXCAVATOR-480(33)");
             combo_equipmentnumber.addItem("EXCAVATOR-210(7))");
             combo_equipmentnumber.addItem("EXCAVATOR-210(14)");
             combo_equipmentnumber.addItem("EXCAVATOR-210(20)");
             combo_equipmentnumber.addItem("EXCAVATOR-200 D(1)");
             combo_equipmentnumber.addItem("EXCAVATOR-200 D(2)");
             combo_equipmentnumber.addItem("EXCAVATOR-2001 B(12)");

        } else if (combo_equipment.getSelectedItem().equals("Drilling Machine")) {
             combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("DRILLING MACHINE-1");
             combo_equipmentnumber.addItem("DRILLING MACHINE-2");
             combo_equipmentnumber.addItem("DRILLING MACHINE-3");
             
        }
        else if (combo_equipment.getSelectedItem().equals("Dozer")) {
             combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("DOZER -1");
             combo_equipmentnumber.addItem("DOZER -3");
             combo_equipmentnumber.addItem("DOZER -5");
             
        }
        else if (combo_equipment.getSelectedItem().equals("Grader")) {
             combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("GRADER-1");

        }
          else if (combo_equipment.getSelectedItem().equals("Loader")) {
             combo_equipmentnumber.removeAllItems();
             combo_equipmentnumber.setSelectedItem(null);
             combo_equipmentnumber.addItem("VOLVO LOADER L150H(2)");
             combo_equipmentnumber.addItem("VOLVO LOADER L150H(3)");
             combo_equipmentnumber.addItem("VOLVO LOADER L150H(6)");
             combo_equipmentnumber.addItem("VOLVO LOADER L150H(8)");
             
        }
        else if (combo_equipment.getSelectedItem().equals("Select Equipment")) {
             combo_equipmentnumber.removeAllItems();

        }

    }//GEN-LAST:event_combo_equipmentActionPerformed

    private void combo_shiftActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combo_shiftActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_combo_shiftActionPerformed

    private void btn_submitActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btn_submitActionPerformed
        // TODO add your handling code here:
        String name, shift, type, equipment, main, sub, id, date, equipmentnumber;

        id = txt_id.getText();
        name = txt_name.getText();
        shift = (String) combo_shift.getSelectedItem();
        equipment = (String) combo_equipment.getSelectedItem();
        equipmentnumber = (String) combo_equipmentnumber.getSelectedItem();
        main = (String) combo_location.getSelectedItem();
        sub = (String) combo_sublocation.getSelectedItem();
        type = (String) combo_type.getSelectedItem();
        date = txt_date.getText();
        if (txt_id.getText().equals("")) {
            JOptionPane.showMessageDialog(null, "Please Enter Operator ID..");
        } else if (combo_shift.getSelectedItem().equals("Select Shift")) {
            JOptionPane.showMessageDialog(null, "Please Select Shift..");
        } else if (combo_equipment.getSelectedItem().equals("Select Equipment")) {
            JOptionPane.showMessageDialog(null, "Please Select Equipment..");
        } 
         else if (combo_equipmentnumber.getSelectedItem().equals("")) {
            JOptionPane.showMessageDialog(null, "Please Select Equipment Number..");
        }else if (combo_location.getSelectedItem().equals("Select Location")) {
            JOptionPane.showMessageDialog(null, "Please Select Main Location..");
        } else if (combo_sublocation.getSelectedItem().equals("")) {
            JOptionPane.showMessageDialog(null, "Please Select Sub Location..");
        } else if (combo_type.getSelectedItem().equals("Select Material Type")) {
            JOptionPane.showMessageDialog(null, "Please Select Material Type..");
        } else {
            try {

                stmt = (Statement) conn.createStatement();
                String sqlqry = "INSERT INTO allocation2 (id,name,shift,equipment,equipmentnumber,location,sub_location,type,date) VALUES ('" + id + "','" + name + "','" + shift + "','" + equipment + "','" + equipmentnumber + "','" + main + "','" + sub + "','" + type + "','" + date + "' )";
                stmt.executeUpdate(sqlqry);

                JOptionPane.showMessageDialog(null, "Record Added Successfully..");

                table_update();

                txt_id.setText("");
                txt_name.setText("");
                combo_equipment.setSelectedIndex(0);
                combo_location.setSelectedIndex(0);
                combo_shift.setSelectedIndex(0);
                combo_type.setSelectedIndex(0);

            } catch (SQLException e1) {
                e1.printStackTrace();

            }

        }


    }//GEN-LAST:event_btn_submitActionPerformed

    private void txt_idActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_txt_idActionPerformed
        // TODO add your handling code here:
        String id = txt_id.getText();
        try {
            pst = conn.prepareStatement("Select * from operator WHERE id='" + id + "' ");
            ResultSet rs = pst.executeQuery();

            if (rs.next()) {
                String name = rs.getString("name");
                txt_name.setText(name);
            } else {
                Component frame = null;
                JOptionPane.showMessageDialog(frame,
                        "Operator ID not Found in Database",
                        "Warning",
                        JOptionPane.WARNING_MESSAGE);
                txt_name.setText("");
            }

        } catch (Exception ex) {

            ex.printStackTrace();
        }

    }//GEN-LAST:event_txt_idActionPerformed

    private void combo_locationActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combo_locationActionPerformed
        // TODO add your handling code here:
        if (combo_location.getSelectedItem().equals("Mines")) {
            combo_sublocation.removeAllItems();
            combo_sublocation.setSelectedItem(null);
            combo_sublocation.addItem("Q1");
            combo_sublocation.addItem("Q2");
        } else if (combo_location.getSelectedItem().equals("Crusher")) {
            combo_sublocation.removeAllItems();
            combo_sublocation.setSelectedItem(null);
            combo_sublocation.addItem("Crusher Area");

        } else if (combo_location.getSelectedItem().equals("Select Location")) {
            combo_sublocation.removeAllItems();

        }
    }//GEN-LAST:event_combo_locationActionPerformed

    private void combo_sublocationActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combo_sublocationActionPerformed
        // TODO add your handling code here:


    }//GEN-LAST:event_combo_sublocationActionPerformed

    private void btn_resetActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btn_resetActionPerformed
        // TODO add your handling code here:
        txt_id.setText("");
        txt_name.setText("");
        combo_equipment.setSelectedIndex(0);
        combo_location.setSelectedIndex(0);
        combo_shift.setSelectedIndex(0);
        combo_type.setSelectedIndex(0);

    }//GEN-LAST:event_btn_resetActionPerformed

    private void txt_idPropertyChange(java.beans.PropertyChangeEvent evt) {//GEN-FIRST:event_txt_idPropertyChange
        // TODO add your handling code here:

    }//GEN-LAST:event_txt_idPropertyChange

    private void txt_filterActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_txt_filterActionPerformed
        // TODO add your handling code here:
        TableRowSorter<TableModel> sorter = new TableRowSorter<TableModel>(((DefaultTableModel) jTable1.getModel()));
        sorter.setRowFilter(RowFilter.regexFilter(txt_filter.getText()));

        jTable1.setRowSorter(sorter);

    }//GEN-LAST:event_txt_filterActionPerformed

    private void btn_exportActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btn_exportActionPerformed
        // TODO add your handling code here:
//        try{
//     JFileChooser fileChooser = new JFileChooser();
//    int retval = fileChooser.showSaveDialog(jButton1);
//
//    if (retval == JFileChooser.APPROVE_OPTION) {
//        File file = fileChooser.getSelectedFile();
//        if (file != null) {
//            if (!file.getName().toLowerCase().endsWith(".xls")) {
//                file = new File(file.getParentFile(), file.getName() + ".xls");
//
//
//
//            }
//
//            try {
//                ExcelExporter exp=new ExcelExporter();
//                exp.exportTable(jTable1, file);
//
//
//                Desktop.getDesktop().open(file);
//            } catch (UnsupportedEncodingException e) {
//                e.printStackTrace();
//
//            } catch (FileNotFoundException e) {
//                e.printStackTrace();
//                System.out.println("not found");
//            } catch (IOException e) {
//                e.printStackTrace();
//            }
//        }
//        }
//
//
//   }catch(Exception e){
//       System.out.println("shit");
//   }
        try {
            JFileChooser jFileChooser = new JFileChooser();
            jFileChooser.showSaveDialog(this);
            File saveFile = jFileChooser.getSelectedFile();

            if (saveFile != null) {
                saveFile = new File(saveFile.toString() + ".xlsx");
                Workbook wb = new XSSFWorkbook();
                Sheet sheet = wb.createSheet("shift_report");

                org.apache.poi.ss.usermodel.Row rowCol = sheet.createRow(0);
                for (int i = 0; i < jTable1.getColumnCount(); i++) {
                    Cell cell = rowCol.createCell(i);
                    cell.setCellValue(jTable1.getColumnName(i));
                }

                for (int j = 0; j < jTable1.getRowCount(); j++) {
                    org.apache.poi.ss.usermodel.Row row = sheet.createRow(j + 1);
                    for (int k = 0; k < jTable1.getColumnCount(); k++) {
                        Cell cell = row.createCell(k);
                        if (jTable1.getValueAt(j, k) != null) {
                            cell.setCellValue(jTable1.getValueAt(j, k).toString());
                        }
                    }
                }
                FileOutputStream out = new FileOutputStream(new File(saveFile.toString()));
                wb.write(out);
                // wb.close();
                out.close();
                openFile(saveFile.toString());
            } else {
                JOptionPane.showMessageDialog(null, "Error in Report Generation");
            }
        } catch (FileNotFoundException e) {
            System.out.println(e);
        } catch (IOException io) {
            System.out.println(io);
        }

    }//GEN-LAST:event_btn_exportActionPerformed

    private void btn_exitActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btn_exitActionPerformed
        // TODO add your handling code here:
        JFrame frame = new JFrame("Exit");
        if (JOptionPane.showConfirmDialog(frame, "Do you really want to exit...", "Login Systems", JOptionPane.YES_NO_OPTION) == JOptionPane.YES_NO_OPTION) {
            System.exit(0);

        }
    }//GEN-LAST:event_btn_exitActionPerformed

    private void combo_equipmentnumberActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_combo_equipmentnumberActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_combo_equipmentnumberActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Equipment.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(Equipment.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(Equipment.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(Equipment.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Equipment().setVisible(true);
            }
            
            
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btn_exit;
    private javax.swing.JButton btn_export;
    private javax.swing.JButton btn_reset;
    private javax.swing.JButton btn_submit;
    private javax.swing.JComboBox<String> combo_equipment;
    private javax.swing.JComboBox<String> combo_equipmentnumber;
    private javax.swing.JComboBox<String> combo_location;
    private javax.swing.JComboBox<String> combo_shift;
    private javax.swing.JComboBox<String> combo_sublocation;
    private javax.swing.JComboBox<String> combo_type;
    private javax.swing.JButton jButton1;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel10;
    private javax.swing.JLabel jLabel11;
    private javax.swing.JLabel jLabel12;
    private javax.swing.JLabel jLabel13;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTable jTable1;
    private javax.swing.JTextField txt_date;
    private javax.swing.JTextField txt_filter;
    private javax.swing.JTextField txt_id;
    private javax.swing.JTextField txt_name;
    // End of variables declaration//GEN-END:variables

}
