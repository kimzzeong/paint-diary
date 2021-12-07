import java.io.IOException;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.*;
import java.util.ArrayList;
import java.util.Random;

public class SocketThreadServer extends Thread{
    public static ArrayList<PrintWriter> m_OutputList;
    private static ServerSocket s_socket;

    public static void main(String[] args){
        System.out.println("소켓서버");
        m_OutputList = new ArrayList<PrintWriter>();

        try{
            //포트 8888번에 대기하는 서버 소켓을 생성한다.

                s_socket = new ServerSocket(8888);


            while(true){
                /* 여기가 JDBC 연결 부분*/
//                Connection connection = null;
//                PreparedStatement pstmt = null;
//                Statement stmt = null;
//                ResultSet rs = null;
//
//                try {
//                    System.out.println("1");
//                    Class.forName("com.mysql.cj.jdbc.Driver");
//
//                    System.out.println("2");
//                    DriverManager.getConnection("jdbc:mysql://3.36.52.195/paint_diary?serverTimezone=UTC","jeongin","cru0817!!");
//                    System.out.println("3");
//
//                    System.out.println("DB연결이 완료되었습니다.");
//
//
////                stmt = connection.createStatement();
////
////                int insertCount = stmt.executeUpdate("INSERT ....");
////
////
////                rs = stmt.executeQuery("SELECT ...");
//
//
//                } catch (SQLException | ClassNotFoundException throwables) {
//                    System.out.println("에러!");
//                    throwables.printStackTrace();
//                }

                //연결을 수용
                Socket c_socket = s_socket.accept();
                //접속한 아이피 출력
                System.out.println(c_socket.getInetAddress());

                ClientManagerThread c_thread = new ClientManagerThread();
                c_thread.setSocket(c_socket);

                m_OutputList.add(new PrintWriter(c_socket.getOutputStream()));

                //클라이언트 수 출력
                System.out.println(m_OutputList.size());
                c_thread.start();
            }
        }catch(IOException e){
            e.printStackTrace();
        }
    }
}
