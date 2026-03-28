import 'package:flutter_test/flutter_test.dart';
import 'package:ktb_account/main.dart';

void main() {
  testWidgets('App starts and shows splash screen', (WidgetTester tester) async {
    await tester.pumpWidget(const KTBAccountApp());
    // Verify the splash screen shows the KTB branding
    expect(find.text('KTB'), findsOneWidget);
  });
}
