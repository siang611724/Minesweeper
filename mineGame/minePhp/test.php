
import javax.swing.*;
import javax.swing.event.*;
import java.awt.*;
import java.awt.event.*;
import java.util.*;

public class Mine extends JFrame implements MouseListener
{
    // 按鈕
    private static MineLabel mb[];
    private static Container container;
    private static JPanel statusPanel;
    private JPanel mainPanel;
    private static JButton resetButton;

    // 炸彈數
    private static int mines;
    // 寬高
    private static int width, height;
    // 按鈕總數
    private static int buttonCount;
    // 使用者點選炸彈的數目
    private static int clickedMineCount;
    // 點對的炸彈數目
    private static int correctClickedMineCount;

    // 影像
    // 按右鍵, 表示這裡有炸彈
    Icon iconHasMine = new ImageIcon("hasMine.jpg");
    // 空的
    Icon iconEmpty = new ImageIcon("empty.jpg");
    // 採到炸彈
    Icon iconGetMine = new ImageIcon("getMine.jpg");
    // 猜錯
    Icon iconError = new ImageIcon("error.jpg");
    // 炸彈
    Icon iconMine = new ImageIcon("mine.jpg");
    // 開始
    Icon iconStart = new ImageIcon("start.gif");
    // 按住滑鼠
    Icon iconPush = new ImageIcon("push.gif");
    // 按鈕掛了
    Icon iconOver = new ImageIcon("over.gif");
    // 預設
    Icon iconDefault = new ImageIcon("default.jpg");
    // 贏了
    Icon iconWin = new ImageIcon("win.gif");

    Icon iconNum[] =
    {
        new ImageIcon("empty.jpg"),
        new ImageIcon("1.jpg"),
        new ImageIcon("2.jpg"),
        new ImageIcon("3.jpg"),
        new ImageIcon("4.jpg"),
        new ImageIcon("5.jpg"),
        new ImageIcon("6.jpg"),
        new ImageIcon("7.jpg"),
        new ImageIcon("8.jpg")
    };

    // 寬高炸彈數
    public Mine( int w , int h , int m )
    {
        super("採地雷"); //標題

        initFrame( w , h , m );

        initButton();

        setAroundMinesCount();

        setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
        pack();  //調整視窗大小至最適合的尺寸
        setResizable(false);
        setVisible(true);  //設定視窗為可見
    }

    // 初始寬, 高, 炸彈數的值
    private void initFrame( int w , int h , int m )
    {
        height = h;
        width = w;
        mines = m;
        buttonCount = width * height ;

        container = getContentPane();
        container.setLayout( new BorderLayout() );

        resetButton = new JButton( iconStart );
        resetButton.addActionListener(new ActionListener()
        {
            public void actionPerformed(ActionEvent e)
            {
                resetButton.setIcon( iconStart );
                mainPanel.removeAll();
                initButton();
                setAroundMinesCount();
                mainPanel.validate();
            }
        });

        mainPanel = new JPanel( new GridLayout( height , width , 1 , 1 ) );
        statusPanel = new JPanel( new BorderLayout() );
        statusPanel.add( resetButton );
        container.add( mainPanel , BorderLayout.CENTER );
        container.add( statusPanel , BorderLayout.SOUTH );
    }

    // 初始按鈕
    private void initButton()
    {
        mb = new MineLabel[ buttonCount ];
        clickedMineCount = 0;
        correctClickedMineCount = 0;

        // 隨機指定炸彈的座標位置
        Set mineIndex = new HashSet();

        while( true )
        {
            int k = ( int )( Math.random() * 10000 ) % ( buttonCount ) ;
            mineIndex.add( new Integer(k) );

            if(mineIndex.size() == mines)
                break;
        }

        // 初始按鈕, 同時根據 Set 裡指定的座標
        // 指定該座標是否有炸彈
        for( int i = 0 ; i < buttonCount ; i++ )
        {
            mb[i] = new MineLabel( iconDefault , i );
            mb[i].addMouseListener( this );

            if( mineIndex.contains( new Integer( i ) ) )
                mb[i].setHasMine( true );

            mainPanel.add( mb[i] );
        }
    }

    // 炸彈 label
    class MineLabel extends JLabel
    {
        private boolean hasMine;    // 這個位置是否放置炸彈
        private boolean userHasMine;    // 使用者是否設定這個位置是炸彈
        private int aroundMineCount;    // 這個位置四周炸彈的數目
        private int mineIndex;  // 該座標的索引值
        private boolean beenClicked;  // 是否被案過了
        public int upIndex , downIndex , rightIndex, leftIndex;
        public int leftUpIndex , rightUpIndex , leftDownIndex , rightDownIndex;

        MineLabel( Icon ic, int mg )
        {
            super(ic);
            mineIndex = mg;
            upIndex = mineIndex - width;
            downIndex = mineIndex + width;
            leftIndex = mineIndex - 1;
            rightIndex = mineIndex + 1;
            leftUpIndex = upIndex - 1;
            rightUpIndex = upIndex + 1;
            leftDownIndex = downIndex - 1;
            rightDownIndex = downIndex + 1;
        }
        // 座標值
        int getMineIndex()
        {
            return mineIndex;
        }

        // 指定這個位置是否有炸彈
        void setHasMine( boolean hm )
        {
            hasMine = hm;
        }
        boolean getHasMine()
        {
            return hasMine;
        }

        // 設定使用者點選的位置為有炸彈
        void setUserHasMine(boolean uhm)
        {
            userHasMine = uhm;
        }
        boolean getUserHasMine()
        {
            return userHasMine;
        }

        // 該座標四周炸彈的數目
        void setAroundMineCount( int amc )
        {
            aroundMineCount = amc;
        }
        int getAroundMineCount()
        {
            return aroundMineCount;
        }

        // 是否已經被點選過了
        void setBeenClicked( boolean bc )
        {
            beenClicked = bc;
        }
        boolean getBeenClicked()
        {
            return beenClicked;
        }

        // 展開四周 aroundMineCount == 0 的位置
        public void checkArround( MineLabel mb )
        {
            ArrayList cache = new ArrayList();
            // 自己四周的位置: null 靠邊 && 已經點過了 && 是炸彈，那麼就不處理該位置了
            if( mb.getUp() != null && mb.getUp().getBeenClicked() == false && mb.getUp().getHasMine() == false)
                cache.add( mb.getUp() );
            if( mb.getDown() != null && mb.getDown().getBeenClicked() == false && mb.getDown().getHasMine() == false)
                cache.add( mb.getDown() );
            if( mb.getLeft() != null && mb.getLeft().getBeenClicked() == false && mb.getLeft().getHasMine() == false)
                cache.add( mb.getLeft() );
            if( mb.getRight() != null && mb.getRight().getBeenClicked() == false && mb.getRight().getHasMine() == false)
                cache.add( mb.getRight() );

            // 先處理自己
            if( mb.getBeenClicked() == false )
            {
                mb.setIcon( iconNum[ mb.getAroundMineCount() ] );
                mb.setBeenClicked( true );
                if( mb.getUserHasMine() == true )
                {
                    mb.setUserHasMine( false );
                    clickedMineCount--;
                }
            }

            // 自己等於零就需要展開
            if( mb.getAroundMineCount() == 0 )
            {
                for( int i = 0 ; i< cache.size() ; i++ )
                {
                    MineLabel m = ( MineLabel )cache.get( i );
                    // 取得該位置四周炸彈的數字, 大於 0 就設定為beenChicked == true
                    if( m.getAroundMineCount() > 0 )
                        m.setIcon( iconNum[ m.getAroundMineCount() ] );
                    // 四周炸彈的數字等於 0  設定 iconEmpty, 再呼叫一次自己
                    else if(m.getAroundMineCount() == 0)
                    {
                        m.setIcon(iconEmpty);
                        m.checkArround(m);  // call self
                    }
                    // 設定已經點過
                    m.setBeenClicked( true );
                    // 因為已經展開 使用者設定有炸彈, 那麼就取消..
                    if( m.getUserHasMine() == true )
                    {
                        clickedMineCount--;
                        m.setUserHasMine(false);
                    }
                }
            }
        }

      
        //取得四周鄰的 MineLabel 物件
        //null 表示自己已經在邊界, 沒有特定的鄰居

        // 取得上面的座標
        private MineLabel getUp()
        {
            return ( upIndex < 0 ? null : mb[ upIndex ] );
        }
        // 取得下面的座標
        private MineLabel getDown()
        {
            return (downIndex >= buttonCount ? null : mb[ downIndex ] );
        }
        // 取得左邊的座標
        private MineLabel getLeft()
        {
            // 座標靠左邊
            if( ( mineIndex % width ) == 0 )
                return null;
            else
                return mb[ leftIndex ];
        }
        // 取得右邊的座標
        private MineLabel getRight()
        {
            // 座標靠右邊
            if( ( mineIndex % width ) == ( width - 1 ) )
                return null;
            else
                return mb[rightIndex];
        }
        // 取得左上座標
        private MineLabel getLeftUp()
        {
            // 上面或者左邊已經是邊邊, 那麼自己也是邊邊了
            if( ( getUp() == null ) || ( getLeft() == null ) )
                return null;
            else
                return mb[ leftUpIndex ];
        }
        // 取得右上座標
        private MineLabel getRightUp()
        {
            // 上面或者左邊已經是邊邊, 那麼自己也是邊邊了
            if( ( getUp() == null ) || ( getRight() == null ) )
                return null;
            else
                return mb[ rightUpIndex ];
        }
        // 取得左下座標
        private MineLabel getLeftDown() {
            // 上面或者左邊已經是邊邊, 那麼自己也是邊邊了
            if( ( getDown() == null ) || ( getLeft() == null))
                return null;
            else
                return mb[ leftDownIndex ];
        }
        // 取得右下座標
        private MineLabel getRightDown()
        {
            // 上面或者左邊已經是邊邊, 那麼自己也是邊邊了
            if( ( getDown() == null ) || ( getRight() == null ) )
                return null;
            else
                return mb[ rightDownIndex ];
        }
    }

    // 要先確定炸彈的位置已經 ok ...
    // 計算全部的每一個座標四周炸彈的數目
    private void setAroundMinesCount()
    {
        for( int i = 0 ; i < buttonCount ; i++ )
        {
            int count = 0;
            if(mb[i].getUp() != null && mb[i].getUp().getHasMine() == true)
                count++;
            if(mb[i].getDown() != null && mb[i].getDown().getHasMine() == true)
                count++;
            if(mb[i].getLeft() != null && mb[i].getLeft().getHasMine() == true)
                count++;
            if(mb[i].getRight() != null && mb[i].getRight().getHasMine() == true)
                count++;
            if(mb[i].getLeftUp() != null && mb[i].getLeftUp().getHasMine() == true)
                count++;
            if(mb[i].getRightUp() != null && mb[i].getRightUp().getHasMine() == true)
                count++;
            if(mb[i].getLeftDown() != null && mb[i].getLeftDown().getHasMine() == true)
                count++;
            if(mb[i].getRightDown() != null && mb[i].getRightDown().getHasMine() == true)
                count++;
            mb[i].setAroundMineCount( count );
        }
    }

    // 顯示每一個座標四周的炸彈數
    private void viewMineGrid()
    {
        for(int i=0; i<buttonCount; i++)
        {
            if(mb[i].getHasMine())// 有炸彈
                mb[i].setIcon( iconMine );
            else// 數字
                mb[i].setText( Integer.toString( mb[i].getAroundMineCount() ) );

            mb[i].removeMouseListener( this );
        }
    }

    // Game over
    public void GameOver( int overIndex )
    {
        resetButton.setIcon( iconOver );
        for( int i = 0; i < buttonCount ; i++)
        {
            if( mb[i].getHasMine() == true )
            {
                if(i == overIndex)
                    mb[i].setIcon( iconGetMine );
                else
                    mb[i].setIcon( iconMine );
            }
            if(mb[i].getUserHasMine() == true && mb[i].getHasMine() == false)
                mb[i].setIcon( iconError );

            mb[i].removeMouseListener( this );
        }
    }


    public void GamePassed()
    {
        for(int i = 0 ; i < buttonCount ; i++)
            mb[i].removeMouseListener( this );

        resetButton.setIcon( iconWin );
        JOptionPane.showMessageDialog( this , "恭喜你贏了！");

    }

    // mouse listener
    public void mouseClicked( MouseEvent e ) { }
    public void mouseEntered( MouseEvent e ){ }
    public void mouseExited( MouseEvent e ) { }
    public void mousePressed( MouseEvent e )
    {
        MineLabel mb = ( MineLabel )e.getSource();
        if( mb.getBeenClicked() == false )
        {
            resetButton.setIcon( iconPush );
            mb.setIcon( iconEmpty );
        }
    }
    public void mouseReleased( MouseEvent e )
    {
        resetButton.setIcon( iconStart );
        MineLabel mb = ( MineLabel )e.getSource();
        // 還沒有被設定過
        if( mb.getBeenClicked() == false )
        {
            // 點選左鍵
            if( e.getButton() == MouseEvent.BUTTON1 )
            {
                // 點到炸彈@@... game over
                if(mb.getHasMine())
                    GameOver(mb.getMineIndex());
                // 看看是四周有多少個炸彈
                else
                    // 遞回展開
                    mb.checkArround(mb);
            }

            // 使用者點滑鼠右鍵,標記為可能有炸彈
            else if( e.getButton() == MouseEvent.BUTTON3 )
            {
                // 還沒設定有炸彈
                if( mb.getUserHasMine() == false && clickedMineCount < mines )
                {
                    mb.setIcon( iconHasMine );
                    mb.setUserHasMine( true );
                    clickedMineCount++;
                    // 猜對了
                    if( mb.getHasMine() )
                    {
                        correctClickedMineCount++;
                        if( correctClickedMineCount == mines )
                            GamePassed();
                    }
                // 已經設定為有炸彈
                }
                else if( mb.getUserHasMine() )
                {
                    mb.setIcon( iconDefault );
                    mb.setUserHasMine( false );
                    clickedMineCount--;
                }
            }
        }      
    }

    public static void main(String[] args)
    {
        String str1 = JOptionPane.showInputDialog( "請輸入寬度\n" );
        String str2 = JOptionPane.showInputDialog( "請輸入高度\n" );
        String str3 = JOptionPane.showInputDialog( "請輸入地雷數\n" );

        int w = Integer.parseInt( str1 );
        int h = Integer.parseInt( str2 );
        int m = Integer.parseInt( str3 );

        new Mine( w , h , m );
    }
}