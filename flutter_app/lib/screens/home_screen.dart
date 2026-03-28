import 'package:flutter/material.dart';
import '../config/theme.dart';
import 'dashboard_tab.dart';
import 'loans_tab.dart';
import 'savings_tab.dart';
import 'notifications_tab.dart';
import 'more_tab.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  int _currentIndex = 0;

  final List<Widget> _tabs = const [
    DashboardTab(),
    LoansTab(),
    SavingsTab(),
    NotificationsTab(),
    MoreTab(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: IndexedStack(
        index: _currentIndex,
        children: _tabs,
      ),
      bottomNavigationBar: Container(
        decoration: BoxDecoration(
          color: AppColors.surface,
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.3),
              blurRadius: 10,
              offset: const Offset(0, -2),
            ),
          ],
        ),
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
            child: BottomNavigationBar(
              currentIndex: _currentIndex,
              onTap: (index) {
                setState(() => _currentIndex = index);
              },
              items: const [
                BottomNavigationBarItem(
                  icon: Icon(Icons.dashboard_outlined),
                  activeIcon: Icon(Icons.dashboard),
                  label: 'หน้าหลัก',
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.account_balance_outlined),
                  activeIcon: Icon(Icons.account_balance),
                  label: 'สินเชื่อ',
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.savings_outlined),
                  activeIcon: Icon(Icons.savings),
                  label: 'เงินฝาก',
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.notifications_outlined),
                  activeIcon: Icon(Icons.notifications),
                  label: 'แจ้งเตือน',
                ),
                BottomNavigationBarItem(
                  icon: Icon(Icons.more_horiz_outlined),
                  activeIcon: Icon(Icons.more_horiz),
                  label: 'อื่นๆ',
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
