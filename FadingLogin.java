import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import javafx.util.Duration;
import javafx.animation.FadeTransition;

public class FadingLogin extends Application {

    @Override
    public void start(Stage primaryStage) {
        primaryStage.setTitle("Fading Login");

        VBox root = new VBox(10);
        Scene scene = new Scene(root, 300, 200);

        // Logo
        Image logoImage = new Image("path/to/your/logo.png");
        ImageView logoImageView = new ImageView(logoImage);
        logoImageView.setFitWidth(100);
        logoImageView.setPreserveRatio(true);

        // SyncTrac Name
        Label syncTracLabel = new Label("SyncTrac");
        syncTracLabel.setStyle("-fx-font-size: 24; -fx-font-weight: bold;");

        Label loginLabel = new Label("Login");
        loginLabel.setStyle("-fx-font-size: 24; -fx-font-weight: bold;");

        Button loginButton = new Button("Login");
        loginButton.setStyle("-fx-font-size: 18;");

        // Set initial opacity to 0
        logoImageView.setOpacity(0);
        syncTracLabel.setOpacity(0);
        loginLabel.setOpacity(0);
        loginButton.setOpacity(0);

        root.getChildren().addAll(logoImageView, syncTracLabel, loginLabel, loginButton);

        primaryStage.setScene(scene);
        primaryStage.show();

        // Create a FadeTransition for the logo
        FadeTransition fadeTransitionLogo = new FadeTransition(Duration.seconds(2), logoImageView);
        fadeTransitionLogo.setFromValue(0);
        fadeTransitionLogo.setToValue(1);
        fadeTransitionLogo.play();

        // Create a FadeTransition for the SyncTrac label
        FadeTransition fadeTransitionSyncTrac = new FadeTransition(Duration.seconds(2), syncTracLabel);
        fadeTransitionSyncTrac.setFromValue(0);
        fadeTransitionSyncTrac.setToValue(1);
        fadeTransitionSyncTrac.play();

        // Create a FadeTransition for the login label
        FadeTransition fadeTransitionLabel = new FadeTransition(Duration.seconds(2), loginLabel);
        fadeTransitionLabel.setFromValue(0);
        fadeTransitionLabel.setToValue(1);
        fadeTransitionLabel.play();

        // Create a FadeTransition for the login button
        FadeTransition fadeTransitionButton = new FadeTransition(Duration.seconds(2), loginButton);
        fadeTransitionButton.setFromValue(0);
        fadeTransitionButton.setToValue(1);
        fadeTransitionButton.play();
    }

    public static void main(String[] args) {
        launch(args);
    }
}
